<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran'; 

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'status', 
        'pesan', 
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
