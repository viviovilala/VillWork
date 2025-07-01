<?php

namespace App\Livewire\Admin\Chat;
use App\Models\Chat;

use Livewire\Component;

class Dashboard extends Component
{
    public $chats;

    public function mount()
    {
        $this->chats = Chat::with(['fromUser', 'toUser'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.chat.dashboard');
    }
}
