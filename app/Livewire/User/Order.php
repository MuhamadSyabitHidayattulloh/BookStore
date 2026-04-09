<?php

namespace App\Livewire\User;

use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;

    public function completeOrder($orderId)
    {
        $order = OrderModel::query()
            ->where('user_id', Auth::id())
            ->where('id', $orderId)
            ->first();

        if (! $order) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan tidak ditemukan.');

            return;
        }

        if ($order->status !== 'shipped') {
            $this->dispatch('toast', type: 'warning', message: 'Pesanan hanya bisa diselesaikan setelah status dikirim.');

            return;
        }

        $order->update([
            'status' => 'completed',
        ]);

        $this->dispatch('toast', type: 'success', message: 'Pesanan ditandai selesai. Terima kasih!');
    }

    #[Computed]
    public function myOrders()
    {
        return OrderModel::with(['items.book'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.user.order');
    }
}
