<?php

use App\Livewire\Admin\Chat;

use Livewire\Component;
use App\Models\User;

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