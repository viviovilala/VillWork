<?php
namespace App\Livewire\Pengguna\Lowongan;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Lowongan Saya')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    public function render()
    {
        $myLowongans = Lowongan::where('user_id', Auth::id())
            ->where('judul_lowongan', 'like', '%' . $this->search . '%')
            ->withCount('lamarans') 
            ->latest()
            ->paginate(10);

        return view('livewire.pengguna.lowongan.index', [
            'myLowongans' => $myLowongans,
        ]);
    }
}
