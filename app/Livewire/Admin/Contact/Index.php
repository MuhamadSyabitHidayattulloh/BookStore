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
        Contact::find($id)->update(['is_read' => true]);
        $this->dispatch('toast', type: 'success', message: 'Pesan ditandai sebagai telah dibaca.');
    }

    public function delete($id)
    {
        Contact::destroy($id);
        $this->dispatch('toast', type: 'success', message: 'Pesan berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.contact.index');
    }
}
