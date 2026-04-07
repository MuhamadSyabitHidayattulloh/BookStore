<?php

namespace App\Livewire\User;

use App\Models\Cart as CartModel;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Cart extends Component
{
    use WithFileUploads;

    public $phone = '';

    public $address = '';

    public $paymentMethod = Order::PAYMENT_METHOD_COD;

    public $transferProof;

    public $selectedItems = [];

    #[Computed]
    public function items()
    {
        return CartModel::with('book')->where('user_id', Auth::id())->get();
    }

    public function mount()
    {
        $user = Auth::user();

        $this->phone = $user?->phone ?? '';
        $this->address = $user?->address ?? '';
        $this->selectedItems = $this->items->pluck('id')->map(fn ($id) => (string) $id)->all();
    }

    public function updatedSelectedItems()
    {
        $this->selectedItems = array_values(array_unique($this->selectedItems));
    }

    public function selectAllItems()
    {
        $this->selectedItems = $this->items->pluck('id')->map(fn ($id) => (string) $id)->all();
    }

    public function deselectAllItems()
    {
        $this->selectedItems = [];
    }

    public function increment($id)
    {
        $cart = CartModel::where('user_id', Auth::id())->find($id);
        if (! $cart) {
            $this->dispatch('toast', type: 'error', message: 'Item keranjang tidak ditemukan.');

            return;
        }

        $cart->increment('quantity');
    }

    public function decrement($id)
    {
        $cart = CartModel::where('user_id', Auth::id())->find($id);
        if (! $cart) {
            $this->dispatch('toast', type: 'error', message: 'Item keranjang tidak ditemukan.');

            return;
        }

        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        }
    }

    public function removeItem($id)
    {
        $deleted = CartModel::where('user_id', Auth::id())->where('id', $id)->delete();
        if (! $deleted) {
            $this->dispatch('toast', type: 'error', message: 'Item keranjang tidak ditemukan.');

            return;
        }

        $this->selectedItems = array_values(array_filter(
            $this->selectedItems,
            fn ($selectedId) => (string) $selectedId !== (string) $id
        ));
    }

    public function checkout()
    {
        $this->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'selectedItems' => ['required', 'array', 'min:1'],
            'paymentMethod' => ['required', 'in:'.Order::PAYMENT_METHOD_COD.','.Order::PAYMENT_METHOD_BANK_TRANSFER],
            'transferProof' => ['required_if:paymentMethod,'.Order::PAYMENT_METHOD_BANK_TRANSFER, 'nullable', 'image', 'max:2048'],
        ]);

        $selectedItemIds = collect($this->selectedItems)
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0)
            ->unique()
            ->values();

        if ($selectedItemIds->isEmpty()) {
            $this->addError('selectedItems', 'Pilih minimal satu item untuk checkout.');

            return;
        }

        $transferProofPath = null;

        if ($this->paymentMethod === Order::PAYMENT_METHOD_BANK_TRANSFER && $this->transferProof) {
            $transferProofPath = $this->transferProof->store('payment-proofs', 'public');
        }

        try {
            DB::transaction(function () use ($selectedItemIds, $transferProofPath) {
                $user = Auth::user();

                $selectedCarts = CartModel::query()
                    ->where('user_id', Auth::id())
                    ->whereIn('id', $selectedItemIds)
                    ->lockForUpdate()
                    ->get();

                if ($selectedCarts->isEmpty()) {
                    throw ValidationException::withMessages([
                        'selectedItems' => 'Item keranjang tidak ditemukan. Muat ulang halaman lalu coba lagi.',
                    ]);
                }

                if ($selectedCarts->count() !== $selectedItemIds->count()) {
                    throw ValidationException::withMessages([
                        'selectedItems' => 'Sebagian item keranjang tidak valid. Muat ulang halaman lalu coba lagi.',
                    ]);
                }

                $books = Book::query()
                    ->whereIn('id', $selectedCarts->pluck('book_id')->all())
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $total = 0;
                foreach ($selectedCarts as $cart) {
                    $book = $books->get($cart->book_id);
                    if (! $book) {
                        throw ValidationException::withMessages([
                            'selectedItems' => 'Data buku tidak ditemukan. Muat ulang halaman lalu coba lagi.',
                        ]);
                    }

                    if ($book->stock < $cart->quantity) {
                        throw ValidationException::withMessages([
                            'selectedItems' => "Stok buku {$book->title} tidak mencukupi.",
                        ]);
                    }

                    $total += $book->price * $cart->quantity;
                }

                $user?->update([
                    'phone' => $this->phone,
                    'address' => $this->address,
                ]);

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $total,
                    'status' => 'process',
                    'payment_method' => $this->paymentMethod,
                    'transfer_proof' => $transferProofPath,
                    'shipping_address' => $this->address,
                ]);

                foreach ($selectedCarts as $cart) {
                    $book = $books->get($cart->book_id);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'book_id' => $cart->book_id,
                        'quantity' => $cart->quantity,
                        'price' => $book->price,
                    ]);

                    $updated = Book::query()
                        ->where('id', $book->id)
                        ->where('stock', '>=', $cart->quantity)
                        ->decrement('stock', $cart->quantity);

                    if (! $updated) {
                        throw ValidationException::withMessages([
                            'selectedItems' => "Stok buku {$book->title} sudah berubah. Coba checkout ulang.",
                        ]);
                    }
                }

                CartModel::where('user_id', Auth::id())
                    ->whereIn('id', $selectedItemIds->all())
                    ->delete();
            });
        } catch (\Throwable $e) {
            if ($transferProofPath) {
                Storage::disk('public')->delete($transferProofPath);
            }

            throw $e;
        }

        return redirect()->route('user.orders')->with('message', 'Pesanan berhasil dibuat!');
    }

    public function getSelectedItemsTotalProperty()
    {
        return $this->items
            ->filter(function ($item) {
                return in_array((string) $item->id, $this->selectedItems, true);
            })
            ->sum(fn ($item) => $item->book->price * $item->quantity);
    }

    public function render()
    {
        return view('livewire.user.cart');
    }
}
