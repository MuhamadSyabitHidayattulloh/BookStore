<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    #[Computed]
    public function stats()
    {
        return [
            'total_books'      => Book::count(),
            'total_users'      => User::where('role', 'user')->count(),
            'total_categories' => Category::count(),
            'total_revenue'    => Order::where('status', 'completed')->sum('total_price'),
            'pending_orders'   => Order::where('status', 'process')->count(),
        ];
    }

    #[Computed]
    public function recentOrders()
    {
        // Mengambil 5 pesanan terbaru untuk ditampilkan di dashboard
        return Order::with('user')->latest()->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
