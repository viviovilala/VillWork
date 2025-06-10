<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Publish Lowongan | VillWork</title>
    <link rel="icon" type="image/png" href="foto/logo_baru.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start">
    {{-- Header - Menggunakan kelas Tailwind --}}
    <header class="fixed top-0 left-0 w-full bg-[#141e43] shadow-md z-50"> {{-- bg-black-primary jika dikonfigurasi --}}
        <nav class="container mx-auto h-14 flex items-center justify-between px-6 sm:px-0"> {{-- h-header-height --}}
            <div class="flex items-center justify-between w-full sm:w-auto h-full">
                <a href="{{ url('dashboard') }}" class="inline-flex items-center gap-1.5 font-semibold text-white">
                    VillWork
                </a>

                <div class="relative w-8 h-8 sm:hidden" id="nav-toggle">
                    <i class="ri-menu-line absolute inset-0 m-auto text-xl cursor-pointer transition-opacity duration-400 nav__burger"></i>
                    <i class="ri-close-line absolute inset-0 m-auto text-xl cursor-pointer opacity-0 transition-opacity duration-400 nav__close"></i>
                </div>
            </div>

            <div class="absolute left-0 top-10 w-full h-[calc(100vh-3.5rem)] overflow-auto pointer-events-none opacity-0 transition-all duration-300 sm:relative sm:top-0 sm:h-auto sm:overflow-visible sm:opacity-100 sm:pointer-events-auto sm:transition-none" id="nav-menu">
                <ul class="bg-[#141e43] pt-4 sm:bg-transparent sm:p-0 sm:h-full sm:flex sm:items-center sm:gap-12"> {{-- bg-black-primary --}}
                    <li><a href="{{ url('dashboard') }}" class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">Home</a></li> {{-- hover:bg-black-light --}}

                    <li class="group dropdown__item cursor-pointer">
                        <div class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">
                            Cari Kerja <i class="ri-arrow-down-s-line text-xl font-normal transition-transform duration-400 group-hover:rotate-180 dropdown__arrow"></i>
                        </div>

                        <ul class="max-h-0 overflow-hidden transition-all duration-400 ease-out sm:absolute sm:top-24 sm:left-0 sm:opacity-0 sm:pointer-events-none sm:transition-opacity sm:group-hover:opacity-100 sm:group-hover:top-20 sm:group-hover:pointer-events-auto sm:max-h-none sm:overflow-visible">
                            <li>
                                <a href="#" class="py-5 px-5 pl-10 text-white bg-[#192653] flex items-center gap-2 font-semibold transition-colors duration-300 hover:bg-[#141e43]"> {{-- bg-black-light --}}
                                    <i class="ri-pie-chart-line"></i> Pekerjaan Terdekat
                                </a>
                            </li>

                            <li>
                                <a href="#" class="py-5 px-5 pl-10 text-white bg-[#192653] flex items-center gap-2 font-semibold transition-colors duration-300 hover:bg-[#141e43]">
                                    <i class="ri-arrow-up-down-line"></i> Riwayat Pekerjaan
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ url('publish_lowongan') }}" class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">Publish Lowongan</a></li>

                    <li class="group dropdown__item cursor-pointer">
                        <div class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">
                            Pelatihan <i class="ri-arrow-down-s-line text-xl font-normal transition-transform duration-400 group-hover:rotate-180 dropdown__arrow"></i>
                        </div>

                        <ul class="max-h-0 overflow-hidden transition-all duration-400 ease-out sm:absolute sm:top-24 sm:left-0 sm:opacity-0 sm:pointer-events-none sm:transition-opacity sm:group-hover:opacity-100 sm:group-hover:top-20 sm:group-hover:pointer-events-auto sm:max-h-none sm:overflow-visible">
                            <li>
                                <a href="{{ url('pelatihan') }}" class="py-5 px-5 pl-10 text-white bg-[#192653] flex items-center gap-2 font-semibold transition-colors duration-300 hover:bg-[#141e43]">
                                    <i class="ri-presentation-line"></i>Pelatihan Terbaru
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('pendaftaran_pelatihan') }}" class="py-5 px-5 pl-10 text-white bg-[#192653] flex items-center gap-2 font-semibold transition-colors duration-300 hover:bg-[#141e43]">
                                    <i class="ri-add-circle-line"></i>Tambah Pelatihan
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('riwayat_pelatihan') }}" class="py-5 px-5 pl-10 text-white bg-[#192653] flex items-center gap-2 font-semibold transition-colors duration-300 hover:bg-[#141e43]">
                                    <i class="ri-user-line"></i>Pelatihan Saya
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ url('charity') }}" class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">Charity</a></li>

                    <li><a href="{{ url('profile') }}" class="text-white bg-[#141e43] font-semibold py-5 px-6 flex justify-between items-center transition-colors duration-300 hover:bg-[#192653] sm:p-0 sm:bg-transparent sm:hover:bg-transparent">Profile</a></li>
                </ul>
            </div>
        </nav>
    </header>

    @livewire('manage-lowongan')

    @livewireScripts
    <script>
        // Custom JavaScript untuk Navigasi (tetap di sini)
        const showMenu = (toggleId, navId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId);

            toggle.addEventListener('click', () => {
                nav.classList.toggle('show-menu'); // Add show-menu class to nav menu
                toggle.classList.toggle('show-icon'); // Add show-icon to show and hide the icon
            });
        };

        showMenu('nav-toggle', 'nav-menu');

        // Untuk menutup dropdown ketika mengklik di luar (jika diperlukan)
        document.addEventListener('click', (event) => {
            const dropdownItems = document.querySelectorAll('.dropdown__item');
            dropdownItems.forEach(item => {
                // Periksa apakah event.target ada di dalam item atau di dalam menu dropdownnya
                if (!item.contains(event.target)) {
                    // Hanya sembunyikan jika menu sedang terbuka (opsional, karena CSS hover juga mengontrolnya)
                    const dropdownMenu = item.querySelector('.dropdown__menu');
                    const dropdownArrow = item.querySelector('.dropdown__arrow');

                    // Hapus kelas yang menjaga dropdown tetap terbuka jika diklik di luar
                    // Ini mungkin menimpa perilaku hover CSS. Sesuaikan sesuai kebutuhan UI/UX Anda.
                    // Jika Anda ingin *hanya* hover yang mengontrol, mungkin baris ini tidak diperlukan
                    // atau harus disesuaikan dengan transisi CSS Anda.
                    // Untuk Livewire, interaksi ini lebih sering ditangani di komponen Livewire.
                    // Namun, karena ini adalah JavaScript murni untuk navigasi, kita bisa biarkan.
                    dropdownMenu?.classList.remove('max-h-1000'); // Atau class yang sesuai
                    dropdownArrow?.classList.remove('rotate-180'); // Atau class yang sesuai
                }
            });
        });
    </script>
</body>

</html>