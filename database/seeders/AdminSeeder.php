<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // 
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'nama' => 'Admin VillWork',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin#1234'),
        ]);
    }
}
