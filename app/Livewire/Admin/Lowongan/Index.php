<?php

// File: app/Livewire/Admin/Lowongan/Index.php

namespace App\Livewire\Admin\Lowongan;

use App\Models\Lowongan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Kelola Lowongan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    public function render()
    {
        $lowongans = Lowongan::with('user')
            ->where('judul_lowongan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.lowongan.index', [
            'lowongans' => $lowongans
        ]);
    }
}
