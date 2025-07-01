<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Lowongan;
use App\Models\Chat;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Carbon\Carbon; // Import Carbon untuk format tanggal jika diperlukan di Blade

#[Layout('layouts.guest')] // Pastikan ini mengarah ke layout yang benar
#[Title('Chat Room')]
class Room extends Component
{
    public $messages = []; // Ini akan menampung array dari data pesan
    public $text = '';
    public $toUser;
    public $lowongan;

    protected $listeners = ['echo:chat-channel,MessageSent' => 'loadMessages'];

    public function mount(Lowongan $lowongan, User $user)
    {
        $this->lowongan = $lowongan;
        $this->toUser = $user;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        // PENTING: Tambahkan ->toArray() setelah ->get()
        $this->messages = Chat::with(['fromUser', 'toUser']) // Pastikan relasi ini ada di model Chat
            ->where('lowongan_id', $this->lowongan->id)
            ->where(function ($q) {
                $q->where('from_user_id', auth()->id())
                    ->where('to_user_id', $this->toUser->id);
            })->orWhere(function ($q) {
                $q->where('from_user_id', $this->toUser->id)
                    ->where('to_user_id', auth()->id());
            })
            ->orderBy('created_at')
            ->get()
            ->toArray(); // <-- Inilah perubahan kuncinya!
    }

    public function sendMessage()
    {
        $this->validate([
            'text' => 'required|string|max:1000',
        ]);

        Chat::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->toUser->id,
            'lowongan_id' => $this->lowongan->id,
            'message' => $this->text,
        ]);

        $this->text = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat.room');
    }
}