<?php

// File: app/Livewire/Admin/User/Index.php
// Logika untuk menampilkan dan mengelola semua pengguna.

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Kelola Pengguna')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function delete(User $user): void
    {
        // Untuk keamanan, kita tidak akan menghapus admin utama
        if ($user->email === 'admin@gmail.com') {
            session()->flash('error', 'Akun admin utama tidak dapat dihapus.');
            return;
        }

        $user->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user.index', [
            'users' => $users,
        ]);
    }
}
