<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran'; // Memastikan nama tabelnya 'lamaran' (tunggal)

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'status', // Kolom status sudah ada di DB Anda
        'pesan',  // Kolom pesan sudah ada di DB Anda
    ];

    /**
     * Get the lowongan that owns the Lamaran.
     */
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    /**
     * Get the user that owns the Lamaran.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
