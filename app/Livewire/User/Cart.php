<?php

namespace App\Livewire\User;

use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    public $phone = '';

    public $address = '';

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
        $cart = CartModel::find($id);
        $cart->increment('quantity');
    }

    public function decrement($id)
    {
        $cart = CartModel::find($id);
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        }
    }

    public function removeItem($id)
    {
        CartModel::destroy($id);

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
        ]);

        $selectedItems = $this->items->filter(function ($item) {
            return in_array((string) $item->id, $this->selectedItems, true);
        });

        if ($selectedItems->isEmpty()) {
            $this->addError('selectedItems', 'Pilih minimal satu item untuk checkout.');

            return;
        }

        DB::transaction(function () {
            Auth::user()->update([
                'phone' => $this->phone,
                'address' => $this->address,
            ]);

            $selectedItems = $this->items->filter(function ($item) {
                return in_array((string) $item->id, $this->selectedItems, true);
            });

            $total = $selectedItems->sum(fn ($item) => $item->book->price * $item->quantity);

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'proccess',
                'shipping_address' => $this->address,
            ]);

            foreach ($selectedItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price,
                ]);
                // Kurangi stok buku
                $item->book->decrement('stock', $item->quantity);
            }

            CartModel::where('user_id', Auth::id())
                ->whereIn('id', $selectedItems->pluck('id'))
                ->delete();
        });

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
