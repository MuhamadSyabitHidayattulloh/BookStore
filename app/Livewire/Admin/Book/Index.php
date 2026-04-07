<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $search = '';

    public $isOpen = false;

    // Form Properties
    public $bookId;

    public $category_id;

    public $title;

    public $author;

    public $description;

    public $price;

    public $stock;

    public $cover;

    public $oldCover;

    // Reset halaman saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function books()
    {
        return Book::with('category')
            ->where(function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('author', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->bookId = $id;
        $this->category_id = $book->category_id;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->description = $book->description;
        $this->price = $book->price;
        $this->stock = $book->stock;
        $this->oldCover = $book->cover;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover' => $this->bookId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'category_id' => $this->category_id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
        ];

        if ($this->cover) {
            if ($this->oldCover) {
                Storage::disk('public')->delete($this->oldCover);
            }
            $data['cover'] = $this->cover->store('covers', 'public');
        }

        Book::updateOrCreate(['id' => $this->bookId], $data);
        $this->closeModal();
        $this->dispatch('toast', type: 'success', message: 'Data berhasil disimpan!');
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();
        $this->dispatch('toast', type: 'success', message: 'Buku berhasil dihapus.');
    }

    private function resetFields()
    {
        $this->reset(['bookId', 'category_id', 'title', 'author', 'description', 'price', 'stock', 'cover', 'oldCover']);
    }

    public function render()
    {
        return view('livewire.admin.book.index');
    }
}
