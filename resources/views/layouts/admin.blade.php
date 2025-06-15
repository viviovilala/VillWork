<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - VillWork</title>
    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body>
    <div id="admin-layout">
        <aside id="sidebar">
            <header>
                <a href="{{ route('admin.dashboard') }}">Admin VillWork</a>
            </header>
            <nav>
                <ul>
                    <li>
                        {{-- Link ke Dashboard Admin --}}
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        {{-- Link ke halaman pengelolaan Pelatihan --}}
                        <a href="{{ route('admin.pelatihan.index') }}">Kelola Pelatihan</a>
                    </li>
                    <li>
                        {{-- Nanti bisa ditambahkan link lain, misal Kelola User --}}
                        <a href="#">Kelola User</a>
                    </li>
                    <li>
                        <hr>
                        {{-- Form untuk Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <main id="main-content">
            <header>
                <h1>{{ $title ?? 'Dashboard' }}</h1>
                <div>
                    Selamat datang, {{ auth()->user()->name }}
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