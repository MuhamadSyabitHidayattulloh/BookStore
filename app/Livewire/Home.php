<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    public $name = '';

    public $email = '';

    public $subject = '';

    public $message = '';

    #[Computed]
    public function featuredHighlights()
    {
        return [
            [
                'label' => 'Koleksi Aktif',
                'value' => Book::count(),
                'description' => 'Katalog buku terus diperbarui dengan koleksi populer dan terbaru.',
            ],
            [
                'label' => 'Genre Beragam',
                'value' => 'Multi Kategori',
                'description' => 'Dari fiksi, bisnis, pengembangan diri, hingga bacaan teknis.',
            ],
            [
                'label' => 'Alur Belanja',
                'value' => 'Cepat & Rapi',
                'description' => 'Pilih buku, kelola keranjang, dan pantau pesanan dengan mudah.',
            ],
        ];
    }

    #[Computed]
    public function workflowSteps()
    {
        return [
            'Jelajahi koleksi berdasarkan kategori.',
            'Simpan buku pilihan ke keranjang.',
            'Checkout dan pantau pesanan dari halaman user.',
        ];
    }

    #[Computed]
    public function popularBooks()
    {
        return Book::query()
            ->with('category')
            ->withSum('orderItems as total_sold', 'quantity')
            ->orderByDesc('total_sold')
            ->orderByDesc('id')
            ->take(6)
            ->get();
    }

    #[Computed]
    public function contactChannels()
    {
        return [
            'support@bookstore.com',
            '+62 812-3456-7890',
            'Jakarta, Indonesia',
        ];
    }

    public function sendContact()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        session()->flash('warning', 'Silakan login terlebih dahulu untuk mengirim pesan.');
    }

    public function render()
    {
        return view('livewire.home');
    }
}