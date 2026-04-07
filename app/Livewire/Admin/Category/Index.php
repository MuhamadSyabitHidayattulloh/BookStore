<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $isOpen = false;

    public $categoryId;

    public $name;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function categories()
    {
        return Category::withCount('books')
            ->where('name', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate(['name' => 'required|string|unique:categories,name,'.$this->categoryId]);
        Category::updateOrCreate(['id' => $this->categoryId], ['name' => $this->name]);
        $this->closeModal();
        $this->dispatch('toast', type: 'success', message: 'Berhasil disimpan!');
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function delete($id)
    {
        $cat = Category::findOrFail($id);
        if ($cat->books()->count() > 0) {
            $this->dispatch('toast', type: 'error', message: 'Kategori ada isinya!');

            return;
        }
        $cat->delete();
        $this->dispatch('toast', type: 'success', message: 'Kategori berhasil dihapus.');
    }

    private function resetFields()
    {
        $this->reset(['categoryId', 'name']);
    }

    public function render()
    {
        return view('livewire.admin.category.index');
    }
}
