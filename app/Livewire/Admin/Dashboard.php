<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Pelatihan;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\PesertaPelatihan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $users = User::latest()->take(5)->get();
        $pelatihans = Pelatihan::latest()->take(5)->get();
        $lowongans = Lowongan::with('user')->latest()->take(5)->get();
        $lamarans = Lamaran::with(['user', 'lowongan'])->latest()->take(5)->get();
        $pesertaPelatihans = PesertaPelatihan::with(['user', 'pelatihan'])->latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'users' => $users,
            'pelatihans' => $pelatihans,
            'lowongans' => $lowongans,
            'lamarans' => $lamarans,
            'pesertaPelatihans' => $pesertaPelatihans,
        ]);
    }
}
