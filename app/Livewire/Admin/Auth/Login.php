<?php

// File ini harus disimpan di:
// app/Livewire/Admin/Auth/Login.php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Menggunakan layout 'guest' dari Breeze
#[Layout('layouts.guest')]
#[Title('Login Admin')]
class Login extends Component
{
    // Properti yang akan terhubung ke form
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * Method ini akan dipanggil saat form di-submit.
     */
    public function login()
    {
        // Validasi input
        $credentials = $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $this->remember)) {
            session()->regenerate();
            // Jika berhasil, arahkan ke dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal, tambahkan pesan error
        $this->addError('email', 'Kredensial yang diberikan tidak cocok.');
    }

    /**
     * Merender file view.
     */
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
