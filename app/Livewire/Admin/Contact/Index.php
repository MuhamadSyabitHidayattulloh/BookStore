<?php

namespace App\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed]
    public function messages()
    {
        return Contact::latest()->paginate(10);
    }

    public function markAsRead($id)
    {
        $contact = Contact::find($id);
        if (! $contact) {
            $this->dispatch('toast', type: 'error', message: 'Pesan tidak ditemukan.');

            return;
        }

        $contact->update(['is_read' => true]);
        $this->dispatch('toast', type: 'success', message: 'Pesan ditandai sebagai telah dibaca.');
    }

    public function delete($id)
    {
        $deleted = Contact::where('id', $id)->delete();
        if (! $deleted) {
            $this->dispatch('toast', type: 'error', message: 'Pesan tidak ditemukan.');

            return;
        }

        $this->dispatch('toast', type: 'success', message: 'Pesan berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.contact.index');
    }
}
