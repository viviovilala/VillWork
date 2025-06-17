<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VillWork</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <nav class="bg-white/80 backdrop-blur-sm sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-gray-800">
                VillWork
            </a>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#fitur" class="text-gray-600 hover:text-gray-800 transition-colors">Fitur</a>
                <a href="#testimoni" class="text-gray-600 hover:text-gray-800 transition-colors">Developer</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors shadow-md">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
            <div class="md:hidden">
                <button class="text-gray-800 focus:outline-none">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <header class="bg-gray-50">
        <div class="container mx-auto px-6 py-20 md:py-32 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                Gerbang Menuju Karir Impian Anda
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                Platform terpadu untuk menemukan lowongan kerja terbaik dan mengikuti pelatihan untuk meningkatkan keahlian Anda.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-transform hover:scale-105 shadow-lg">
                    Daftar Sekarang
                </a>
                <a href="#fitur" class="bg-white text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-transform hover:scale-105 border border-gray-200">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Apa yang Kami Tawarkan?</h2>
                <p class="mt-2 text-gray-600">Dua layanan utama untuk kesuksesan karir Anda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fa fa-briefcase fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Lowongan Kerja Terkurasi</h3>
                    <p class="text-gray-600">
                        Temukan ribuan lowongan dari perusahaan terpercaya yang sesuai dengan minat dan keahlian Anda. Proses lamaran yang mudah dan cepat.
                    </p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fa fa-certificate fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Pelatihan Bersertifikat</h3>
                    <p class="text-gray-600">
                        Tingkatkan kompetensi Anda dengan berbagai pilihan pelatihan online dari para ahli di bidangnya. Dapatkan sertifikat untuk menunjang CV Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="bg-indigo-50 py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Kata Mereka Tentang VillWork</h2>
                <p class="mt-2 text-gray-600">Kami bangga telah membantu mereka mencapai impian.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <img src="https://i.pravatar.cc/100?u=a" alt="User" class="w-16 h-16 rounded-full mx-auto -mt-12 border-4 border-white">
                    <p class="mt-4 text-gray-600 italic">"Melalui VillWork, saya berhasil mendapatkan pekerjaan impian saya hanya dalam 2 minggu. Platformnya sangat mudah digunakan!"</p>
                    <p class="mt-4 font-bold">- Budi Santoso</p>
                    <p class="text-sm text-gray-500">Web Developer</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <img src="https://i.pravatar.cc/100?u=b" alt="User" class="w-16 h-16 rounded-full mx-auto -mt-12 border-4 border-white">
                    <p class="mt-4 text-gray-600 italic">"Pelatihan Digital Marketing di sini materinya sangat relevan dengan industri saat ini. Sangat membantu untuk upgrade skill."</p>
                    <p class="mt-4 font-bold">- Citra Lestari</p>
                    <p class="text-sm text-gray-500">Mahasiswi</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <img src="https://i.pravatar.cc/100?u=c" alt="User" class="w-16 h-16 rounded-full mx-auto -mt-12 border-4 border-white">
                    <p class="mt-4 text-gray-600 italic">"Sebagai recruiter, mencari talenta di VillWork lebih efisien. Kandidat yang melamar sangat berkualitas."</p>
                    <p class="mt-4 font-bold">- Dian Purnomo</p>
                    <p class="text-sm text-gray-500">HR Manager</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 py-20 text-center">
            <h2 class="text-3xl font-bold">Siap Mengambil Langkah Selanjutnya?</h2>
            <p class="mt-4 text-gray-300 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengguna lainnya dan mulailah perjalanan karir Anda bersama VillWork hari ini.
            </p>
            <div class="mt-8">
                <a href="{{ route('register') }}" class="bg-green-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-600 transition-transform hover:scale-105 shadow-lg">
                    Buat Akun Gratis
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900">
        <div class="container mx-auto px-6 py-6 text-center text-gray-400">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p>&copy; 2025 VillWork. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>