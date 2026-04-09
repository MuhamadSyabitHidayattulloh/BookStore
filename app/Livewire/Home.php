<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    public $selectedBook = null;

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

    #[Computed]
    public function selectedBookInCart()
    {
        if (! Auth::check() || ! $this->selectedBook) {
            return false;
        }

        return Cart::query()
            ->where('user_id', Auth::id())
            ->where('book_id', $this->selectedBook->id)
            ->exists();
    }

    public function sendContact()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $this->dispatch('toast', type: 'warning', message: 'Silakan login terlebih dahulu untuk mengirim pesan.');
    }

    public function showDetail($id)
    {
        $book = Book::with('category')->find($id);
        if (! $book) {
            $this->dispatch('toast', type: 'error', message: 'Buku tidak ditemukan.');

            return;
        }

        $this->selectedBook = $book;
    }

    public function closeModal()
    {
        $this->selectedBook = null;
    }

    public function addToCart($bookId)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $book = Book::find($bookId);
        if (! $book) {
            $this->dispatch('toast', type: 'error', message: 'Buku tidak ditemukan.');

            return;
        }

        $alreadyExists = Cart::query()
            ->where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->exists();

        if ($alreadyExists) {
            $this->dispatch('toast', type: 'warning', message: 'Buku ini sudah ada di keranjang Anda.');

            return;
        }

        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'quantity' => 1,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function render()
    {
        return view('livewire.home');
    }
}