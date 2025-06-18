<?php
// File 3: app/Livewire/Pengguna/Lowongan/History.php
// Deskripsi: Komponen untuk halaman 'Kelola Lowongan Saya' (Riwayat).

namespace App\Livewire\Pengguna\Lowongan;

use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Kelola Lowongan Saya')]
class History extends Component
{
    public $myLowongans;
    public $selectedLowongan;
    public $applicants = [];

    public function mount()
    {
        $this->myLowongans = Lowongan::where('user_id', Auth::id())
            ->withCount('lamarans')
            ->latest()
            ->get();
    }

    public function viewApplicants($lowonganId)
    {
        $this->selectedLowongan = Lowongan::with('lamarans.user')
            ->where('id', $lowonganId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->applicants = $this->selectedLowongan->lamarans;
    }

    public function updateStatus($lamaranId, $newStatus)
    {
        // Pastikan status yang diberikan valid
        if (!in_array($newStatus, ['diterima', 'ditolak'])) {
            return;
        }

        $lamaran = Lamaran::find($lamaranId);

        // Validasi tambahan: pastikan pengguna hanya bisa mengubah status lamaran pada lowongan miliknya
        if ($lamaran && $lamaran->lowongan->user_id == Auth::id()) {
            $lamaran->status = $newStatus;
            $lamaran->save();

            // Refresh daftar pelamar untuk menampilkan status baru
            $this->viewApplicants($lamaran->lowongan_id);
            session()->flash('status_success', 'Status pelamar berhasil diperbarui.');
        }
    }

    public function render()
    {
        return view('livewire.pengguna.lowongan.history');
    }
}
// ====================================================================================================
