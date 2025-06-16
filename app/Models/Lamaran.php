<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // INI BAGIAN PENTING:
    // Memberitahu Laravel bahwa model ini terhubung ke tabel 'lamaran' (tunggal).
    protected $table = 'lamaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Daftarkan semua kolom yang boleh diisi melalui form.
    protected $fillable = [
        'user_id',
        'lowongan_id',
        'cv_path',
        'status',
    ];

    /**
     * Mendefinisikan relasi ke model User (pelamar).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi ke model Lowongan (pekerjaan yang dilamar).
     */
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
