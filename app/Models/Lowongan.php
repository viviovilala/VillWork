<?php
// File 1: app/Models/Lowongan.php
// Deskripsi: Model Eloquent untuk berinteraksi dengan tabel 'lowongan'.
// Pastikan semua kolom yang akan diisi ada di dalam properti $fillable.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'lowongan';

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal.
     * Ini adalah bagian penting untuk memperbaiki error 'Mass Assignment'.
     */
    protected $fillable = [
        'user_id',
        'judul_lowongan',
        'deskripsi',
        'gaji',
        'lokasi',
        'tanggal_mulai',
    ];

    /**
     * Memberitahu Laravel untuk memperlakukan kolom ini sebagai objek Tanggal (Carbon).
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
    ];

    /**
     * Relasi ke model User (satu lowongan dimiliki oleh satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }
}
// ====================================================================================================
