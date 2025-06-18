<?php

namespace App\Livewire\Admin\Pelatihan;

use Livewire\Component;
use App\Models\Pelatihan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Form Pelatihan')]
class Form extends Component
{
    public ?Pelatihan $pelatihan;
    public string $nama_pelatihan = '';
    public string $deskripsi = '';
    public string $tanggal_mulai = '';
    public string $tanggal_selesai = '';

    protected function rules()
    {
        return [
            'nama_pelatihan' => 'required|string|min:5|max:255',
            'deskripsi' => 'required|string|min:10',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    protected array $messages = [
        'nama_pelatihan.required' => 'Nama pelatihan wajib diisi.',
        'nama_pelatihan.min' => 'Nama pelatihan minimal 5 karakter.',
        'deskripsi.required' => 'Deskripsi pelatihan wajib diisi.',
        'deskripsi.min' => 'Deskripsi pelatihan minimal 10 karakter.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_mulai.date' => 'Format tanggal mulai tidak valid.',
        'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
        'tanggal_selesai.date' => 'Format tanggal selesai tidak valid.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
    ];

    public function mount($pelatihan = null)
    {
        $this->pelatihan = $pelatihan instanceof Pelatihan ? $pelatihan : new Pelatihan();

        if ($this->pelatihan->exists) {
            $this->nama_pelatihan = $this->pelatihan->nama_pelatihan;
            $this->deskripsi = $this->pelatihan->deskripsi;
            $this->tanggal_mulai = $this->pelatihan->tanggal_mulai ? Carbon::parse($this->pelatihan->tanggal_mulai)->format('Y-m-d') : '';
            $this->tanggal_selesai = $this->pelatihan->tanggal_selesai ? Carbon::parse($this->pelatihan->tanggal_selesai)->format('Y-m-d') : '';
        }
    }

    public function save()
    {
        // --- DEBUGGING: CEK APAKAH METHOD SAVE TERPANGGIL ---
        // Ini akan muncul setiap kali tombol submit ditekan.
        // Jika ini tidak muncul, ada masalah pada wire:submit="save" di form Anda.
   
        // --- AKHIR DEBUGGING ---

        // Pindahkan validasi ke setelah dd() sementara untuk debugging
        $validatedData = $this->validate();

        Log::info('Validated data for Pelatihan save:', $validatedData);

        try {
            $this->pelatihan->fill($validatedData)->save();
            Log::info('Pelatihan saved successfully. ID:', ['id' => $this->pelatihan->id]);
            session()->flash('success', 'Data pelatihan berhasil disimpan.');
            return $this->redirect(route('admin.pelatihan.index'), navigate: true);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                $errorMessage = 'Terjadi kesalahan database: Ada kolom wajib yang belum terisi atau terjadi duplikasi data.';
                session()->flash('error', $errorMessage);
                Log::error('SQLSTATE 23000 Error saving pelatihan: ' . $e->getMessage(), ['exception' => $e, 'data' => $validatedData]);
            } else {
                $errorMessage = 'Terjadi kesalahan saat menyimpan data pelatihan: ' . $e->getMessage();
                session()->flash('error', $errorMessage);
                Log::error('Database Query Error saving pelatihan: ' . $e->getMessage(), ['exception' => $e, 'data' => $validatedData]);
            }
        } catch (\Exception $e) {
            $errorMessage = 'Terjadi kesalahan tidak terduga: ' . $e->getMessage();
            session()->flash('error', $errorMessage);
            Log::error('Unexpected error saving pelatihan: ' . $e->getMessage(), ['exception' => $e, 'data' => $validatedData]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pelatihan.form');
    }
}
