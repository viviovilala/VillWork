<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - VillWork</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col justify-between">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl font-bold mb-8 block">Admin VillWork</a>
                <nav>
                    @auth('admin')
                        <ul class="space-y-2">
                            <li><a href="{{ route('admin.dashboard') }}" class="block p-2 rounded hover:bg-gray-700">Dashboard</a></li>
                            <li><a href="{{ route('admin.pelatihan.index') }}" class="block p-2 rounded hover:bg-gray-700">Kelola Pelatihan</a></li>
                        </ul>
                    @endauth
                </nav>
            </div>
            @auth('admin')
                <div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left p-2 rounded hover:bg-red-500">Logout</button>
                    </form>
                </div>
            @endauth
        </aside>

        {{-- Konten Utama --}}
        <main class="flex-1 p-10">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-semibold">{{ $title ?? 'Halaman Admin' }}</h2>
                <div>
                    @auth('admin')
                        <span>Selamat datang, {{ auth('admin')->user()->name }}</span>
                    @endauth
                </div>
            </header>
            
            {{-- KONTEN DINAMIS DARI SETIAP HALAMAN AKAN MUNCUL DI SINI --}}
            {{ $slot }}

        </main>
    </div>
    @livewireScripts
</body>
</html>
