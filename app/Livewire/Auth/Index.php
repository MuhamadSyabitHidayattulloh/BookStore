<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithFileUploads;

    // Form Properties
    public $name, $email, $password, $password_confirmation, $phone, $address, $avatar;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            $role = Auth::user()->role;
            return redirect()->intended($role === 'admin' ? '/admin/dashboard' : '/explore');
        }

        $this->dispatch('toast', type: 'error', message: 'Email atau password salah.');
    }

    public function register()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone'    => 'nullable|numeric',
            'address'  => 'nullable|string',
            'avatar'   => 'nullable|image|max:1024',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'phone'    => $this->phone,
            'address'  => $this->address,
            'role'     => 'user', // Default register as user
        ]);

        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        Auth::login($user);
        return redirect()->to('/explore');
    }

    public function render()
    {
        return view('livewire.auth.index');
    }
}
