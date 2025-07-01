<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VillWork</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logowhite.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .banner-slide {
            animation: slideBanner 9s infinite;
        }

        @keyframes slideBanner {

            0%,
            33% {
                background-image: url('/storage/banner1.jpg');
            }

            34%,
            66% {
                background-image: url('/storage/banner2.jpg');
            }

            67%,
            100% {
                background-image: url('/storage/banner3.jpg');
            }
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    <nav class="bg-white/80 backdrop-blur-sm sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-gray-800">VillWork</a>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#fitur" class="text-gray-600 hover:text-gray-800 transition-colors">Fitur</a>
                <a href="#grafik" class="text-gray-600 hover:text-gray-800 transition-colors">Statistik</a>
                <a href="#desa" class="text-gray-600 hover:text-gray-800 transition-colors">Desa</a>
                <a href="#testimoni" class="text-gray-600 hover:text-gray-800 transition-colors">Testimoni</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-md">Register</a>
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

    <section class="h-[90vh] bg-cover bg-center flex items-center justify-center banner-slide text-white text-center">
        <div class="bg-black/50 p-10 rounded-xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di VillWork</h1>
            <p class="text-lg md:text-xl">Menjembatani Desa dan Dunia Kerja melalui Teknologi</p>
        </div>
    </section>

    @auth
        @livewire('pengguna.dashboard')
    @endauth

    <section id="fitur" class="py-20 bg-gradient-to-br from-white via-gray-50 to-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Apa yang Kami Tawarkan?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Rangkaian fitur unggulan untuk mendukung kemajuan karirmu —
                    dari desa hingga ke dunia global.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <a href="{{ auth()->check() ? route('lowongan.index') : route('login') }}"
                    class="group bg-white p-8 rounded-2xl border border-gray-200 shadow-md hover:shadow-2xl hover:border-indigo-500 transition duration-300">
                    <div
                        class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fa fa-briefcase fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2 group-hover:text-indigo-700">Lowongan Kerja</h3>
                    <p class="text-gray-600">Terkurasi, terpercaya, dan relevan bagi masyarakat desa dan umum. Mulai
                        petualangan karirmu sekarang.</p>
                </a>

                <a href="{{ auth()->check() ? route('pelatihan.index') : route('login') }}"
                    class="group bg-white p-8 rounded-2xl border border-gray-200 shadow-md hover:shadow-2xl hover:border-green-500 transition duration-300">
                    <div
                        class="bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fa fa-certificate fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2 group-hover:text-green-700">Pelatihan Bersertifikat</h3>
                    <p class="text-gray-600">Perluas skill-mu lewat pelatihan interaktif, gratis, dan bersertifikat yang
                        siap mengantar ke dunia profesional.</p>
                </a>

                <a href="{{ auth()->check() ? route('desa.digital') : route('login') }}"
                    class="group bg-white p-8 rounded-2xl border border-gray-200 shadow-md hover:shadow-2xl hover:border-yellow-500 transition duration-300">
                    <div
                        class="bg-yellow-100 text-yellow-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fa fa-network-wired fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2 group-hover:text-yellow-700">Jaringan Desa Digital</h3>
                    <p class="text-gray-600">Bangun konektivitas dan ekonomi desa berbasis teknologi demi masa depan
                        yang lebih inklusif dan sejahtera.</p>
                </a>
            </div>
        </div>
    </section>


    <section id="cara-daftar" class="bg-white py-24">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-indigo-800 mb-12">Cara Daftar di <span
                    class="text-yellow-500">VillWork</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left">
                <div
                    class="p-8 bg-gradient-to-br from-indigo-100 via-white to-indigo-200 rounded-xl shadow-lg step-card border-l-[6px] border-indigo-400 hover:scale-[1.05] transition duration-700 ease-in-out">
                    <div class="flex items-center mb-4">
                        <div class="text-indigo-500 text-3xl mr-4"><i class="fas fa-user-plus"></i></div>
                        <h3 class="text-xl font-bold">1. Buat Akun</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">Klik tombol <strong>Register</strong> dan isi data diri
                        Anda secara lengkap untuk mulai bergabung.</p>
                </div>
                <div
                    class="p-8 bg-gradient-to-br from-green-100 via-white to-green-200 rounded-xl shadow-lg step-card border-l-[6px] border-green-400 hover:scale-[1.05] transition duration-700 ease-in-out">
                    <div class="flex items-center mb-4">
                        <div class="text-green-500 text-3xl mr-4"><i class="fas fa-id-card"></i></div>
                        <h3 class="text-xl font-bold">2. Lengkapi Profil</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">Isi pengalaman kerja, keahlian, dan minat Anda untuk
                        mendapatkan rekomendasi terbaik.</p>
                </div>
                <div
                    class="p-8 bg-gradient-to-br from-yellow-100 via-white to-yellow-200 rounded-xl shadow-lg step-card border-l-[6px] border-yellow-400 hover:scale-[1.05] transition duration-700 ease-in-out">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500 text-3xl mr-4"><i class="fas fa-rocket"></i></div>
                        <h3 class="text-xl font-bold">3. Mulai Jelajahi</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">Akses berbagai <strong>lowongan kerja</strong>,
                        <strong>pelatihan</strong>, dan <strong>fitur jaringan</strong> desa digital.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="artikel-desa" class="py-20">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900">Artikel Desa</h2>
                <a href="/artikel" class="text-indigo-600 hover:underline flex items-center gap-2">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/storage/artikel1.jpeg" class="w-full h-40 object-cover rounded-md mb-4"
                        alt="Inovasi Digital di Desa Kedungwungu">
                    <h3 class="text-xl font-bold mb-2">Inovasi Digital di Desa Kedungwungu</h3>
                    <p class="text-gray-600 text-sm mb-3">Desa Kedungwungu sukses menerapkan teknologi untuk
                        meningkatkan ekonomi warga.</p>
                    <a href="/artikel/1" class="text-indigo-600 text-sm hover:underline">Selengkapnya</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/storage/artikel2.jpg" class="w-full h-40 object-cover rounded-md mb-4"
                        alt="Pelatihan UMKM Digital">
                    <h3 class="text-xl font-bold mb-2">Pelatihan UMKM Digital</h3>
                    <p class="text-gray-600 text-sm mb-3">Warga desa mengikuti pelatihan UMKM berbasis digital marketing
                        untuk perluasan pasar.</p>
                    <a href="/artikel/2" class="text-indigo-600 text-sm hover:underline">Selengkapnya</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/storage/artikel3.jpg" class="w-full h-40 object-cover rounded-md mb-4"
                        alt="Digitalisasi Pasar Desa">
                    <h3 class="text-xl font-bold mb-2">Digitalisasi Pasar Desa</h3>
                    <p class="text-gray-600 text-sm mb-3">Langkah konkret desa dalam membangun sistem pasar online
                        lokal.</p>
                    <a href="/artikel/3" class="text-indigo-600 text-sm hover:underline">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan-chat" class="bg-gray-50 py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Butuh Bantuan?</h2>
            <p class="text-gray-600 mb-6 max-w-xl mx-auto">Kami hadir untuk mendukung langkahmu. Kirim pesan langsung
                dan dapatkan solusi cepat dari tim layanan pelanggan kami yang sigap dan ramah.</p>

            <div class="mt-8 flex justify-center">
                <a href="{{ auth()->check() ? route('chat.index') : route('login') }}"
                    class="inline-flex items-center gap-3 bg-indigo-600 text-white px-6 py-3 rounded-full font-medium hover:bg-indigo-700 shadow-lg transition duration-300">
                    <i class="fas fa-comments text-lg"></i>
                    <span>Buka Layanan Chat</span>
                </a>
            </div>

            <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -top-10 -right-10 w-60 h-60 bg-yellow-100 rounded-full blur-2xl opacity-40"></div>
        </div>
    </section>

    <section id="grafik" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Statistik Pengguna VillWork</h2>
            <div id="apexChart" class="max-w-4xl mx-auto"></div>

            <div class="overflow-x-auto mt-10">
                <table class="min-w-full table-auto border-collapse border border-gray-200 shadow-sm rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 border border-gray-200">Bulan</th>
                            <th class="px-6 py-3 border border-gray-200">Pengguna Baru</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Januari</td>
                            <td class="px-6 py-3 border border-gray-200">120</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Februari</td>
                            <td class="px-6 py-3 border border-gray-200">200</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Maret</td>
                            <td class="px-6 py-3 border border-gray-200">340</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">April</td>
                            <td class="px-6 py-3 border border-gray-200">580</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Mei</td>
                            <td class="px-6 py-3 border border-gray-200">770</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Juni</td>
                            <td class="px-6 py-3 border border-gray-200">950</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">Juli</td>
                            <td class="px-6 py-3 border border-gray-200">1300</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
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
        </script>
    </section>

    <section id="testimoni" class="bg-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Kata Mereka Tentang <span
                    class="text-indigo-600">VillWork</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-indigo-50 via-white to-indigo-100 p-6 rounded-xl shadow-md">
                    <img src="https://i.pravatar.cc/100?u=a" alt="User" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 italic">"VillWork membuka peluang kerja yang tak pernah saya bayangkan sebelumnya."
                    </p>
                    <p class="mt-2 font-semibold text-indigo-700">Budi Santoso, Web Developer</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 via-white to-green-100 p-6 rounded-xl shadow-md">
                    <img src="https://i.pravatar.cc/100?u=b" alt="User" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 italic">"Pelatihannya keren banget, bisa langsung dipakai di dunia kerja."</p>
                    <p class="mt-2 font-semibold text-green-700">Citra Lestari, Mahasiswi</p>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 via-white to-yellow-100 p-6 rounded-xl shadow-md">
                    <img src="https://i.pravatar.cc/100?u=c" alt="User" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 italic">"Rekrutmen jadi mudah dan efektif. Sangat membantu HR!"</p>
                    <p class="mt-2 font-semibold text-yellow-700">Dian Purnomo, HR Manager</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-gray-800 to-gray-900 text-white">
        <div class="container mx-auto px-4 py-12 text-center max-w-3xl">
            <h2 class="text-3xl font-extrabold mb-3">Langkah Awal, Masa Depan Cerah!</h2>
            <p class="mt-2 text-gray-300">Bersama <span class="text-yellow-400 font-semibold">VillWork</span>, wujudkan
                perubahan nyata dari desa untuk dunia. Jangan tunggu esok, mulai hari ini!</p>
            <div class="mt-6">
                <a href="{{ route('register') }}"
                    class="bg-green-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-green-600 transition-transform hover:scale-105 shadow-lg">Daftar
                    Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
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