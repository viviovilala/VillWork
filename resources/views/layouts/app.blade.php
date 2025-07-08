<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VillWork - Dashboard Aktivitas</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logowhite.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Chart.js and ApexCharts are separate libraries, ensure both are needed --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js" defer></script>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            background-color: #e8e8e8;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #c0c0c0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a0a0a0;
        }
    </style>
    {{-- Include Livewire Styles --}}
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">
    {{-- Mobile menu (hidden by default) --}}
    <div id="mobile-menu" class="fixed inset-0 bg-white z-50 p-6 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
        <div class="flex justify-end mb-8">
            <button id="close-mobile-menu" class="text-gray-800 focus:outline-none">
                <i class="fa fa-times text-2xl"></i>
            </button>
        </div>
        <nav class="flex flex-col space-y-6 text-xl">
            <a href="#aktivitas-saya" class="text-gray-800 hover:text-indigo-600 transition-colors">Aktivitas Saya</a>
            <a href="#fitur-utama" class="text-gray-800 hover:text-indigo-600 transition-colors">Fitur Utama</a>
            <a href="#statistik" class="text-gray-800 hover:text-indigo-600 transition-colors">Statistik</a>
            <a href="#artikel" class="text-gray-800 hover:text-indigo-600 transition-colors">Artikel</a>
            <a href="#testimoni" class="text-gray-800 hover:text-indigo-600 transition-colors">Testimoni</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors shadow-md text-center">Dashboard Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition-colors shadow-md">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-800 hover:text-indigo-600 transition-colors">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-md text-center">Register</a>
                @endif
            @endauth
        </nav>
    </div>

    <nav class="bg-white/80 backdrop-blur-sm sticky top-0 z-50 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">VillWork</a>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#aktivitas-saya" class="text-gray-600 hover:text-gray-800 transition-colors">Aktivitas Saya</a>
                <a href="#fitur-utama" class="text-gray-600 hover:text-gray-800 transition-colors">Fitur Utama</a>
                <a href="#statistik" class="text-gray-600 hover:text-gray-800 transition-colors">Statistik</a>
                <a href="#artikel" class="text-gray-600 hover:text-gray-800 transition-colors">Artikel</a>
                <a href="#testimoni" class="text-gray-600 hover:text-gray-800 transition-colors">Testimoni</a>
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors shadow-md">Dashboard
                        Saya</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-md">Register</a>
                    @endif
                @endauth
            </div>
            <div class="md:hidden">
                <button id="open-mobile-menu" class="text-gray-800 focus:outline-none" aria-label="Open mobile menu">
                    <i class="fa fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- Konten utama halaman akan disuntikkan di sini --}}
    <div class="min-h-screen">
        <main class="py-10">
            <div class="container mx-auto px-6">
                @yield('content') {{-- Ini adalah tempat konten spesifik halaman akan muncul --}}
            </div>
        </main>
    </div>

    <footer class="bg-gray-900">
        <div class="container mx-auto px-6 py-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} VillWork. All rights reserved.</p> {{-- Menambahkan tahun dinamis --}}
        </div>
    </footer>

    {{-- Include Livewire Scripts --}}
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle logic
            const openMenuButton = document.getElementById('open-mobile-menu');
            const closeMenuButton = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');

            if (openMenuButton && mobileMenu) {
                openMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.remove('-translate-x-full');
                });
            }

            if (closeMenuButton && mobileMenu) {
                closeMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.add('-translate-x-full');
                });
            }

            // Close mobile menu when a link is clicked (for smoother navigation on single-page-like dashboards)
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('-translate-x-full');
                });
            });

            // ApexCharts initialization (pastikan elemen #apexChart ada di @yield('content'))
            // Jika chart ini selalu ada di setiap halaman yang menggunakan layout ini,
            // Anda bisa membiarkannya di sini. Namun, jika ini hanya untuk dashboard,
            // lebih baik inisialisasi di file Blade dashboard itu sendiri.
            // Saya akan membiarkannya di sini untuk saat ini sesuai input Anda,
            // tetapi dengan catatan bahwa ini mungkin lebih baik di komponen Livewire dashboard.
            if (document.querySelector("#apexChart")) {
                var options = {
                    chart: {
                        type: 'area',
                        height: 400,
                        toolbar: {
                            show: false
                        },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        }
                    },
                    series: [{
                        name: 'Pengguna Baru',
                        data: [120, 200, 340, 580, 770, 950, 1300]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul']
                    },
                    colors: ['#4f46e5'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.2,
                            stops: [0, 90, 100]
                        }
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5,
                        colors: ['#4f46e5'],
                        strokeColors: '#fff',
                        strokeWidth: 2
                    },
                    dataLabels: {
                        enabled: false
                    },
                    grid: {
                        borderColor: '#e0e0e0',
                        strokeDashArray: 4
                    }
                };
                var chart = new ApexCharts(document.querySelector("#apexChart"), options);
                chart.render();
            }
        });
    </script>
</body>

</html>