<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $phone, $address, $role, $avatar;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:admin,user',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' => $this->role,
        ]);

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);
        }

        session()->flash('success', 'Registration successful. Please log in.');
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
