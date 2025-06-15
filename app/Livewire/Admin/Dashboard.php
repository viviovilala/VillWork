<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout; // 1. Import class Layout
use Livewire\Attributes\Title;

// 2. Gunakan Attribute #[Layout] untuk mendefinisikan layout di sini
#[Layout('layouts.admin')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    /**
     * Render komponen.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // 3. Sekarang Anda tidak perlu lagi menambahkan ->layout() di sini.
        //    Layout sudah diatur oleh Attribute di atas.
        return view('livewire.admin.dashboard');
    }
}
