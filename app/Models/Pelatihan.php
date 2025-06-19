<?php // Pastikan ini adalah baris pertama, tanpa spasi kosong di atasnya

namespace App\Models; // Ini harus langsung setelah <?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $table = 'pelatihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
