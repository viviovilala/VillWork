<?php
// File 1: app/Livewire/Pengguna/Lamaran/Index.php (DIREVISI)
// Deskripsi: Komponen ini sekarang hanya bertugas untuk menampilkan daftar lowongan.
// Logika untuk 'apply' telah dihapus dari sini.

namespace App\Livewire\Pengguna\Lamaran;

use App\Models\Lowongan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cari Lowongan Pekerjaan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    // Metode 'apply()' telah dihapus dari sini karena sekarang ditangani oleh form terpisah.

    public function render()
    {
        $lowongans = Lowongan::with('user')
            ->where(function ($query) {
                $query->where('judul_lowongan', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(9);

        return view('livewire.pengguna.lamaran.index', [
            'lowongans' => $lowongans,
        ]);
    }
}
// ====================================================================================================
?>