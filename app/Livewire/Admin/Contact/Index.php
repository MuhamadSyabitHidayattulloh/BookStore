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
    }

    public function delete($id)
    {
        Contact::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin.contact.index');
    }
}
