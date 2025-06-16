<?php
namespace App\Livewire\Admin\Lamaran;

use App\Models\Lamaran;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Kelola Lamaran')]
class Index extends Component
{
use WithPagination;
public string $search = '';

public function render()
{
$lamarans = Lamaran::with(['user', 'lowongan'])
->whereHas('user', function ($query) {
$query->where('name', 'like', '%' . $this->search . '%');
})
->orWhereHas('lowongan', function ($query) {
$query->where('judul_lowongan', 'like', '%' . $this->search . '%');
})
->latest()
->paginate(10);

return view('livewire.admin.lamaran.index', [
'lamarans' => $lamarans
]);
}
}