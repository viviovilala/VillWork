<?php

namespace App\Livewire\Pengguna\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Show extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pengguna.artikel.show');
    }
}
