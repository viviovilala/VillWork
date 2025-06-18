<?php
// File 2: app/Livewire/Pengguna/Lowongan/Create.php
// Deskripsi: Komponen Livewire yang menangani semua logika untuk form pembuatan lowongan.

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
    // Properti untuk menampung data dari setiap input di form
    public string $judul_lowongan = '';
    public string $deskripsi = '';
    public string $gaji = '';
    public string $lokasi = '';
    public string $tanggal_mulai = '';

    // Aturan validasi untuk setiap input
    protected function rules()
    {
        return [
            'judul_lowongan' => 'required|string|min:5|max:255',
            'deskripsi'      => 'required|string|min:5',
            // Pastikan nilai gaji tidak melebihi batas kolom decimal(10,2) di database
            'gaji'           => 'required|numeric|min:0|max:9999999999999999999999999.99',
            'lokasi'         => 'required|string|max:255',
            'tanggal_mulai'  => 'required|date|after_or_equal:today',
        ];
    }

    // Memberi nilai awal untuk tanggal saat komponen dimuat
    public function mount()
    {
        $this->tanggal_mulai = Carbon::today()->format('Y-m-d');
    }

    // Metode yang dipanggil saat tombol 'Publish Lowongan' ditekan
    public function save()
    {
        $validatedData = $this->validate();

        // Tambahkan ID pengguna yang sedang login ke dalam data
        $validatedData['user_id'] = Auth::id();

        // Buat data lowongan baru di database
        Lowongan::create($validatedData);

        session()->flash('success', 'Lowongan berhasil di-publish!');
        return redirect()->route('lowongan.index'); // Redirect ke dashboard setelah berhasil
    }

    public function render()
    {
        return view('livewire.pengguna.lowongan.create');
    }
}
// ====================================================================================================
