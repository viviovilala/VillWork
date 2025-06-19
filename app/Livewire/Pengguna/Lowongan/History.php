<?php
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
        if (!in_array($newStatus, ['diterima', 'ditolak'])) {
            return;
        }

        $lamaran = Lamaran::find($lamaranId);
        if ($lamaran && $lamaran->lowongan->user_id == Auth::id()) {
            $lamaran->status = $newStatus;
            $lamaran->save();
            $this->viewApplicants($lamaran->lowongan_id);
            session()->flash('status_success', 'Status pelamar berhasil diperbarui.');
        }
    }

    public function render()
    {
        return view('livewire.pengguna.lowongan.history');
    }
}
?>
