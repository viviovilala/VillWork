<?php
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

    public function daftar($pelatihanId)
    {
        $userId = Auth::id();
        $isAlreadyRegistered = PesertaPelatihan::where('user_id', $userId)
            ->where('pelatihan_id', $pelatihanId)
            ->exists();

        if ($isAlreadyRegistered) {
            session()->flash('warning', 'Anda sudah terdaftar pada pelatihan ini.');
            return;
        }
        PesertaPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $pelatihanId,
        ]);
        session()->flash('success', 'Anda berhasil mendaftar pada pelatihan!');
    }

    public function render()
    {
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(9); 
        return view('livewire.pengguna.pelatihan.index', [
            'pelatihans' => $pelatihans,
        ]);
    }
}
