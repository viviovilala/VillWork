<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels'; // atau 'artikel' jika kamu pakai itu
    protected $fillable = [
        'judul',
        'excerpt',
        'isi',
        'gambar',
        'published_at',
    ];
}
