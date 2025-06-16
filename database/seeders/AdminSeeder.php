<?php

// File: database/seeders/AdminSeeder.php
// PASTIKAN SEMUA 'use' STATEMENT INI ADA DAN BENAR.

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // <-- Pastikan ini menunjuk ke model Admin Anda.
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kode ini akan membuat satu data baru di tabel 'admins'
        Admin::create([
            'nama' => 'Admin VillWork',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin#1234'),
        ]);
    }
}
