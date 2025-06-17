<?php

// File: app/Livewire/Admin/User/Index.php
// Logika untuk menampilkan dan mengelola semua pengguna.

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Tambahkan use statement untuk export dan chart
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Kelola Pengguna')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    // Method delete Anda yang sudah ada dipertahankan
    public function delete(User $user): void
    {
        // Untuk keamanan, kita tidak akan menghapus admin utama
        if ($user->email === 'admin@gmail.com') {
            session()->flash('error', 'Akun admin utama tidak dapat dihapus.');
            return;
        }

        $user->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    // Method baru untuk trigger download Excel
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'daftar-pengguna-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        // Logika query pengguna Anda yang sudah ada dipertahankan
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        // --- Logika baru untuk Data Chart ---
        // Menghitung jumlah pengguna yang mendaftar dalam 7 hari terakhir
        $userRegistrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Memformat data untuk Chart.js
        $labels = $userRegistrations->map(function ($item) {
            return Carbon::parse($item->date)->format('d M');
        });

        $data = $userRegistrations->map(function ($item) {
            return $item->count;
        });

        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];
        // --- Akhir Logika Chart ---

        // Kirim data users dan data chart ke view
        return view('livewire.admin.user.index', [
            'users' => $users,
            'chartData' => $chartData, // Variabel baru untuk chart
        ]);
    }
}
