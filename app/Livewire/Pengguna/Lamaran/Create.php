<?php

namespace App\Livewire\Pengguna\Lamaran;

use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Kirim Lamaran')]
class Create extends Component
{
    public Lowongan $lowongan;
    public string $pesan = '';

    protected $rules = [
        'pesan' => 'required|string',
    ];

    public function mount(Lowongan $lowongan)
    {
        $this->lowongan = $lowongan;
    }

    public function save()
    {
        $this->validate();

        $hasApplied = Lamaran::where('user_id', Auth::id())
            ->where('lowongan_id', $this->lowongan->id)
            ->exists();

        if ($hasApplied) {
            session()->flash('warning', 'Anda sudah pernah melamar pada lowongan ini.');
            return redirect()->route('lamaran.index');
        }

        Lamaran::create([
            'user_id'     => Auth::id(),
            'lowongan_id' => $this->lowongan->id,
            'status'      => 'Diproses',
            'pesan'       => $this->pesan,
        ]);

        session()->flash('success', 'Lamaran Anda berhasil terkirim!');
        return redirect()->route('lamaran.index');
    }

    public function render()
    {
        return view('livewire.pengguna.lamaran.create');
    }
}
