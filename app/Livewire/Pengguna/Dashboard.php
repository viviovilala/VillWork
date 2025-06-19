<?php
namespace App\Livewire\Pengguna;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\PesertaPelatihan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Dashboard Pengguna')]
class Dashboard extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $lamaranTerkirimCount = Lamaran::where('user_id', 'like', $userId)->count();
        $pelatihanDiikutiCount = PesertaPelatihan::where('user_id', $userId)->count();
        $lowonganDipostingCount = Lowongan::where('user_id', $userId)->count();

        $lamaranDilihatCount = Lamaran::where('user_id', $userId)
            ->where('status', '!=', 'pending')
            ->count();

        $lamaranTerbaru = Lamaran::with('lowongan')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        $pelatihanTerbaru = PesertaPelatihan::with('pelatihan')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        $lowonganTerbaru = Lowongan::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        $aktivitas = $lamaranTerbaru
            ->concat($pelatihanTerbaru)
            ->concat($lowonganTerbaru)
            ->sortByDesc('created_at')
            ->take(3);
        return view('livewire.pengguna.dashboard', [
            'lamaranTerkirimCount' => $lamaranTerkirimCount,
            'lamaranDilihatCount' => $lamaranDilihatCount,
            'pelatihanDiikutiCount' => $pelatihanDiikutiCount,
            'lowonganDipostingCount' => $lowonganDipostingCount,
            'aktivitasTerbaru' => $aktivitas,
        ]);
    }
}
