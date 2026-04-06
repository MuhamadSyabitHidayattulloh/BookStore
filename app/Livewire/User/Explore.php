<?php

namespace App\Livewire\User;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Explore extends Component
{
    use WithPagination;

    public $search = '';

    public $categoryId = null;

    public $selectedBook = null; // Untuk Modal Detail

    public $perPage = 12; 

    public function loadMore()
    {
        $this->perPage += 12;
    }

    // Reset ke halaman 1 jika filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    #[Computed]
    public function books()
    {
        return Book::with('category')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('author', 'like', '%'.$this->search.'%');
            })
            ->when($this->categoryId, fn ($q) => $q->where('category_id', $this->categoryId))
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    #[Computed]
    public function cartBookIds()
    {
        if (! Auth::check()) {
            return collect();
        }

        return Cart::where('user_id', Auth::id())
            ->pluck('book_id')
            ->map(fn ($id) => (int) $id);
    }

    #[Computed]
    public function selectedBookInCart()
    {
        if (! $this->selectedBook) {
            return false;
        }

        return $this->cartBookIds->contains((int) $this->selectedBook->id);
    }

    public function showDetail($id)
    {
        $this->selectedBook = Book::with('category')->find($id);
    }

    public function closeModal()
    {
        $this->selectedBook = null;
    }

    public function addToCart($bookId)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah buku sudah ada di keranjang user ini
        $cart = Cart::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->first();

        if ($cart) {
            session()->flash('warning', 'Buku ini sudah ada di keranjang Anda.');

            return;
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        // Kirim notifikasi (opsional)
        session()->flash('message', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function render()
    {
        return view('livewire.user.explore');
    }
}
