<?php

// File: database/seeders/DatabaseSeeder.php
// PASTIKAN BARIS `$this->call(...)` TIDAK BERADA DI DALAM KOMENTAR.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Baris ini akan memberitahu Laravel untuk menjalankan
        // AdminSeeder saat proses seeding.
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
