<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - VillWork</title>
    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body>
    <div id="admin-layout">
        <aside id="sidebar">
            <header>
                <a href="#">Admin VillWork</a>
            </header>
            <nav>
                <ul>
                    {{-- Tampilkan link ini hanya jika admin sudah login --}}
                    @auth('admin')
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.pelatihan.index') }}">Kelola Pelatihan</a></li>
                        <li><a href="#">Kelola User</a></li>
                        <li>
                            <hr>
                            <form method="POST" action="#">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </aside>

        <main id="main-content">
            <header>
                <h1>{{ $title ?? 'Login Admin' }}</h1>
                <div>
                    {{--
                        INI BAGIAN YANG DIPERBAIKI
                        Gunakan @auth untuk mengecek apakah user sudah login
                        sebelum mencoba menampilkan namanya.
                    --}}
                    @auth('admin')
                        Selamat datang, {{ auth('admin')->user()->nama }}
                    @else
                        Silakan login untuk melanjutkan
                    @endauth
                </div>
            </header>

            {{-- Di sinilah konten dari setiap halaman akan dimuat --}}
            {{ $slot }}

        </main>
    </div>

    {{-- Livewire Scripts --}}
    @livewireScripts
</body>
</html>