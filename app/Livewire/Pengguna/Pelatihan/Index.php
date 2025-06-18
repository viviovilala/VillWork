<?php

// [DIPERBAIKI] Namespace disesuaikan dengan struktur folder yang Anda inginkan
namespace App\Livewire\Pengguna\Pelatihan;

use App\Models\Pelatihan;
use App\Models\PesertaPelatihan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cari Pelatihan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    /**
     * Method untuk mendaftarkan pengguna ke sebuah pelatihan.
     */
    public function daftar($pelatihanId)
    {
        $userId = Auth::id();

        // Cek apakah pengguna sudah terdaftar di pelatihan ini
        $isAlreadyRegistered = PesertaPelatihan::where('user_id', $userId)
            ->where('pelatihan_id', $pelatihanId)
            ->exists();

        if ($isAlreadyRegistered) {
            // Jika sudah, kirim pesan peringatan
            session()->flash('warning', 'Anda sudah terdaftar pada pelatihan ini.');
            return;
        }

        // Jika belum, daftarkan pengguna
        PesertaPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $pelatihanId,
        ]);

        // Kirim pesan sukses
        session()->flash('success', 'Anda berhasil mendaftar pada pelatihan!');
    }

    public function render()
    {
        // Ambil semua data pelatihan dengan pencarian dan pagination
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(9); // Menampilkan 9 item per halaman agar pas di grid 3x3

        // [DIPERBAIKI] Path view disesuaikan dengan lokasi komponen
        return view('livewire.pengguna.pelatihan.index', [
            'pelatihans' => $pelatihans,
        ]);
    }
}
