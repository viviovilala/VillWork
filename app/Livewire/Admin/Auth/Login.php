<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')] // Menggunakan layout admin
class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        $this->addError('email', 'Kredensial admin tidak valid.');
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}