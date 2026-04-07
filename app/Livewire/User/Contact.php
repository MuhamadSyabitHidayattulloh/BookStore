<?php

namespace App\Livewire\User;

use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Contact extends Component
{
    public $name;

    public $email;

    public $subject;

    public $message;

    public function send()
    {
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        ContactModel::create([
            'user_id' => Auth::id(),
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
        $this->dispatch('toast', type: 'success', message: 'Pesan Anda telah terkirim!');
    }

    public function render()
    {
        return view('livewire.user.contact');
    }
}
