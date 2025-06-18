<?php

// [DIPERBAIKI] Namespace disesuaikan dengan struktur folder
namespace App\Livewire\Pengguna\Pelatihan;

use App\Models\PesertaPelatihan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Riwayat Pelatihan Saya')]
class History extends Component
{
    public function batalDaftar($pendaftaranId)
    {
        $pendaftaran = PesertaPelatihan::where('id', $pendaftaranId)
            ->where('user_id', Auth::id())
            ->first();

        if ($pendaftaran) {
            $pendaftaran->delete();
            session()->flash('success', 'Pendaftaran berhasil dibatalkan.');
        } else {
            session()->flash('error', 'Gagal membatalkan pendaftaran.');
        }
    }

    public function render()
    {
        $pelatihanTerdaftar = PesertaPelatihan::with('pelatihan.user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // [DIPERBAIKI] Path view disesuaikan
        return view('livewire.pengguna.pelatihan.history', [
            'pelatihanTerdaftar' => $pelatihanTerdaftar,
        ]);
    }
}
