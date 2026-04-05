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
