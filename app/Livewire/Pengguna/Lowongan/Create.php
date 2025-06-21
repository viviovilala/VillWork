<?php
namespace App\Livewire\Pengguna\Lowongan;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Publish Lowongan Baru')]
class Create extends Component
{
    public string $judul_lowongan = '';
    public string $deskripsi = '';
    public string $gaji = '';
    public string $lokasi = '';
    public string $tanggal_mulai = '';

    protected function rules()
    {
        return [
            'judul_lowongan' => 'required|string|min:5|max:255',
            'deskripsi'      => 'required|string|min:5',
            'gaji'           => 'required|numeric|min:0|max:9999999999999999999999999.99',
            'lokasi'         => 'required|string|max:255',
            'tanggal_mulai'  => 'required|date|after_or_equal:today',
        ];
    }
    public function mount()
    {
        $this->tanggal_mulai = Carbon::today()->format('Y-m-d');
    }
    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::id();
        Lowongan::create($validatedData);

        session()->flash('success', 'Lowongan berhasil di-publish!');
        return redirect()->route('lowongan.index'); // Redirect ke dashboard setelah berhasil
    }

    public function render()
    {
        return view('livewire.pengguna.lowongan.create');
    }
}