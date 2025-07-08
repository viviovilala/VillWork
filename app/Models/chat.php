<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo
use App\Models\User; // Import model User

class Chat extends Model
{
    // Tambahkan properti $fillable untuk mengizinkan mass assignment
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'message',
        'read_at', // Kolom untuk menandai pesan sudah dibaca (opsional)
    ];

    // Relasi ke pengguna pengirim
    /**
     * Get the user who sent the message.
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // Relasi ke pengguna penerima
    /**
     * Get the user who received the message.
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    // Jika Anda tidak ingin menggunakan timestamps (created_at, updated_at), set ini ke false
    // public $timestamps = true; // Defaultnya true, jadi tidak perlu ditulis jika ingin true
}