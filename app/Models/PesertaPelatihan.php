<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPelatihan extends Model
{
    use HasFactory;

    protected $table = 'pesertapelatihan';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pelatihan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }
}
