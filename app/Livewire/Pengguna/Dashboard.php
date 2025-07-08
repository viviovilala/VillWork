<?php

namespace App\Livewire\Pengguna;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\PesertaPelatihan;
use App\Models\Artikel;
use App\Models\Testimoni;
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

        // Hitung statistik
        $lamaranTerkirimCount = Lamaran::where('user_id', $userId)->count();
        $pelatihanDiikutiCount = PesertaPelatihan::where('user_id', $userId)->count();
        $lowonganDipostingCount = Lowongan::where('user_id', $userId)->count();

        // Hitung lamaran dilihat (status tidak 'pending')
        $lamaranDilihatCount = Lamaran::where('user_id', $userId)
            ->where('status', '!=', 'pending')
            ->count();

        // Ambil data aktivitas terbaru
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

        // Artikel terbaru
        $artikelTerbaru = Artikel::latest()->take(3)->get();

        // Testimoni pengguna
        $testimoni = Testimoni::latest()->take(3)->get();

        return view('livewire.pengguna.dashboard', [
            'lamaranTerkirimCount' => $lamaranTerkirimCount,
            'lamaranDilihatCount' => $lamaranDilihatCount,
            'pelatihanDiikutiCount' => $pelatihanDiikutiCount,
            'lowonganDipostingCount' => $lowonganDipostingCount,
            'aktivitasTerbaru' => $aktivitas,
            'artikelTerbaru' => $artikelTerbaru,
            'testimoni' => $testimoni,
        ]);
    }
}
