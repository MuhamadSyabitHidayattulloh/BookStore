<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    private const ALLOWED_STATUSES = ['process', 'shipped', 'cancelled'];

    public $search = '';

    public $selectedOrder = null; // Untuk Modal Detail

    public $isOpen = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function orders()
    {
        return Order::with(['user', 'items.book'])
            ->where(function ($query) {
                $query->where('order_number', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'));
            })
            ->latest()
            ->paginate(10);
    }

    public function updateStatus($orderId, $status)
    {
        if (! in_array($status, self::ALLOWED_STATUSES, true)) {
            $this->dispatch('toast', type: 'error', message: 'Status pesanan tidak valid.');

            return;
        }

        $order = Order::find($orderId);
        if (! $order) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan tidak ditemukan.');

            return;
        }

        $order->update(['status' => $status]);
        $this->dispatch('toast', type: 'success', message: 'Status pesanan berhasil diperbarui!');
    }

    public function showDetail($id)
    {
        $order = Order::with(['user', 'items.book'])->find($id);
        if (! $order) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan tidak ditemukan.');

            return;
        }

        $this->selectedOrder = $order;
        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->selectedOrder = null;
    }

    public function render()
    {
        return view('livewire.admin.order.index');
    }
}
