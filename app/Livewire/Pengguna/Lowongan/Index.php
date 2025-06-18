<?php
// File 2: app/Livewire/Pengguna/Lowongan/Index.php (DIUBAH)
// Deskripsi: Komponen untuk halaman "Lowongan Saya", menampilkan lowongan yang telah diposting oleh pengguna.

namespace App\Livewire\Pengguna\Lowongan;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Lowongan Saya')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    public function render()
    {
        // Mengambil lowongan yang HANYA dibuat oleh pengguna yang sedang login
        $myLowongans = Lowongan::where('user_id', Auth::id())
            ->where('judul_lowongan', 'like', '%' . $this->search . '%')
            ->withCount('lamarans') // Menghitung jumlah pelamar
            ->latest()
            ->paginate(10);

        return view('livewire.pengguna.lowongan.index', [
            'myLowongans' => $myLowongans,
        ]);
    }
}
// ====================================================================================================
