<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin VillWork</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('storage/logowhite.png') }}">
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col justify-between fixed">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white text-2xl font-bold mb-8">
                    {{-- Logo --}}
                    <img src="{{ asset('storage/logo_baru.png') }}" alt="Logo VillWork" class="h-10 w-10 mr-3">
                    <span>Admin VillWork</span>
                </a>
                <nav>
                    @auth('admin')
                        <ul class="space-y-2">
                            <li><a href="{{ route('admin.dashboard') }}"
                                    class="block p-2 rounded hover:bg-gray-700">Dashboard</a></li>
                            <li><a href="{{ route('admin.pelatihan.index') }}"
                                    class="block p-2 rounded hover:bg-gray-700">Kelola Pelatihan</a></li>
                            <li><a href="{{ route('admin.peserta-pelatihan.index') }}"
                                    class="block p-2 rounded hover:bg-gray-700">Kelola Peserta Pelatihan</a></li>
                            <li><a href="{{ route('admin.user.index') }}" class="block p-2 rounded hover:bg-gray-700">Kelola
                                    Pengguna</a></li>
                            <li><a href="{{ route('admin.lowongan.index') }}"
                                    class="block p-2 rounded hover:bg-gray-700">Kelola Lowongan</a></li>
                            <li><a href="{{ route('admin.lamaran.index') }}"
                                    class="block p-2 rounded hover:bg-gray-700">Kelola Lamaran</a></li>
                        </ul>
                    @endauth
                </nav>
            </div>
            @auth('admin')
                <div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                            class="box text-center bg-red-600 w-full text-left p-2 rounded hover:bg-red-500 text-a">Logout</button>
                    </form>
                </div>
            @endauth
        </aside>

        <main class="flex-1 p-10 ml-64">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-semibold">{{ $title ?? 'Halaman Admin' }}</h2>
                <div>
                    @auth('admin')
                        <span>Selamat datang, KING</span>
                    @endauth
                </div>
            </header>

            <div class="bg-white p-6 rounded-lg shadow-md">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
    @stack('scripts')
</body>

</html>
