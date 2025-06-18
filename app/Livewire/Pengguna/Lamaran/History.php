<?php
// File 1: app/Livewire/Pengguna/Lamaran/History.php (BARU)
// Deskripsi: Komponen untuk halaman 'Riwayat Lamaran Saya'.

namespace App\Livewire\Pengguna\Lamaran;

use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Riwayat Lamaran Saya')]
class History extends Component
{
    public function render()
    {
        // Mengambil semua data lamaran milik pengguna yang sedang login
        // 'with('lowongan.user')' akan memuat data lowongan dan data user (perusahaan) yang mempostingnya
        $myApplications = Lamaran::where('user_id', Auth::id())
            ->with('lowongan.user')
            ->latest()
            ->get();

        return view('livewire.pengguna.lamaran.history', [
            'myApplications' => $myApplications,
        ]);
    }
}
// ====================================================================================================
