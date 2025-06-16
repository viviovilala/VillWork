<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // INI BAGIAN PENTING:
    // Memberitahu Laravel bahwa model ini terhubung ke tabel 'lowongan' (tunggal).
    protected $table = 'lowongan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Daftarkan semua kolom yang boleh diisi melalui form.
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'status',
    ];

    /**
     * Mendefinisikan relasi ke model User (pembuat lowongan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
