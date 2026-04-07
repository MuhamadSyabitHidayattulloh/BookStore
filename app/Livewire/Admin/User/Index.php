<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    public $userId;

    public $name;

    public $email;

    public $phone;

    public $address;

    public $password;

    public $role = 'user';

    public $avatar;

    public $oldAvatar;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function users()
    {
        return User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
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
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->role = $user->role;
        $this->oldAvatar = $user->avatar;
        $this->password = ''; // Kosongkan password saat edit
        $this->isOpen = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,user',
            'avatar' => 'nullable|image|max:1024',
        ];

        // Password wajib saat create, opsional saat edit
        if (! $this->userId) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->avatar) {
            if ($this->oldAvatar) {
                Storage::disk('public')->delete($this->oldAvatar);
            }
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        $this->closeModal();
        session()->flash('message', 'User berhasil diproses!');
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
        session()->flash('message', 'User berhasil dihapus.');
    }

    private function resetFields()
    {
        $this->reset(['userId', 'name', 'email', 'phone', 'address', 'password', 'role', 'avatar', 'oldAvatar']);
    }

    public function render()
    {
        return view('livewire.admin.user.index');
    }
}
