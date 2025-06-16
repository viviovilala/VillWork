<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // (Opsional) Jika nama tabel Anda 'pelatihan' (tunggal),
    // baris ini memberitahu Laravel untuk tidak mencari 'pelatihans' (jamak).
    protected $table = 'pelatihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // INI BAGIAN YANG DIPERBAIKI:
    // Mendaftarkan semua kolom yang boleh diisi melalui form.
    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'poster',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Baris ini akan otomatis mengubah string tanggal dari database
    // menjadi objek Carbon yang lebih mudah diolah.
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
