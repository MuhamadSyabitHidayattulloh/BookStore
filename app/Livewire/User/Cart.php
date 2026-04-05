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
    #[Computed]
    public function items()
    {
        return CartModel::with('book')->where('user_id', Auth::id())->get();
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
        Cart::destroy($id);
    }

    public function checkout()
    {
        if ($this->items->isEmpty()) {
            return;
        }

        DB::transaction(function () {
            $total = $this->items->sum(fn ($i) => $i->book->price * $i->quantity);

            $order = Order::create([
                'order_number' => 'ORD-'.strtoupper(uniqid()),
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'proccess',
                'shipping_address' => Auth::user()->address ?? 'Alamat belum diatur',
            ]);

            foreach ($this->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price,
                ]);
                // Kurangi stok buku
                $item->book->decrement('stock', $item->quantity);
            }

            CartModel::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('user.orders')->with('message', 'Pesanan berhasil dibuat!');
    }

    public function render()
    {
        return view('livewire.user.cart');
    }
}
