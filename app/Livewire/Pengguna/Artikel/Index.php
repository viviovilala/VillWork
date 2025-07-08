<?php

namespace App\Livewire\Pengguna\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Index extends Component
{
    public function render()
    {
        $artikels = Artikel::orderByDesc('published_at')->get();

        return view('livewire.pengguna.artikel.index', [
            'artikels' => $artikels,
        ])->layout('layouts.app'); 
    }
}
