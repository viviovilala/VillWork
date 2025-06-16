<?php

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Form Pelatihan')]
class Form extends Component
{
    use WithFileUploads;

    public ?Pelatihan $pelatihan;
    public string $nama_pelatihan = '';
    public string $deskripsi = '';
    public $poster;
    public ?string $existingPoster = null;
    public string $tanggal_mulai = '';
    public string $tanggal_selesai = '';

    protected function rules()
    {
        return [
            'nama_pelatihan' => 'required|string|min:5',
            'deskripsi' => 'required|string',
            'poster' => ($this->pelatihan->exists ? 'nullable' : 'required') . '|image|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function mount(Pelatihan $pelatihan)
    {
        $this->pelatihan = $pelatihan;
        if ($this->pelatihan->exists) {
            $this->nama_pelatihan = $pelatihan->nama_pelatihan;
            $this->deskripsi = $pelatihan->deskripsi;
            $this->existingPoster = $pelatihan->poster;
            $this->tanggal_mulai = $pelatihan->tanggal_mulai->format('Y-m-d');
            $this->tanggal_selesai = $pelatihan->tanggal_selesai->format('Y-m-d');
        }
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->poster) {
            if ($this->pelatihan->exists && $this->pelatihan->poster) {
                Storage::disk('public')->delete($this->pelatihan->poster);
            }
            $data['poster'] = $this->poster->store('posters', 'public');
        }

        $this->pelatihan->fill($data)->save();

        session()->flash('success', 'Data pelatihan berhasil disimpan.');
        return $this->redirect(route('admin.pelatihan.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.pelatihan.form');
    }
}