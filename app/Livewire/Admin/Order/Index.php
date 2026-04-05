<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedOrder = null; // Untuk Modal Detail

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function orders()
    {
        return Order::with(['user', 'items.book'])
            ->where('order_number', 'like', '%'.$this->search.'%')
            ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);
    }

    public function updateStatus($orderId, $status)
    {
        Order::find($orderId)->update(['status' => $status]);
        session()->flash('message', 'Status pesanan berhasil diperbarui!');
    }

    public function showDetail($id)
    {
        $this->selectedOrder = Order::with(['user', 'items.book'])->find($id);
    }

    public function render()
    {
        return view('livewire.admin.order.index');
    }
}
