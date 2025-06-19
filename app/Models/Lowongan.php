<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $fillable = [
        'user_id',
        'judul_lowongan',
        'deskripsi',
        'gaji',
        'lokasi',
        'tanggal_mulai',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }
}
?>