<div>
    {{-- === Selamat Datang === --}}
    <section id="aktivitas-saya" class="mb-10">
        <div class="bg-white shadow-sm rounded-lg mb-6 overflow-hidden">
            <div class="p-6 text-white bg-gradient-to-r from-gray-800 to-gray-600 rounded-lg">
                <h3 class="text-2xl font-bold">
                    @auth
                        Selamat datang kembali, {{ Auth::user()->name }}!
                    @else
                        Selamat datang di VillWork!
                    @endauth
                </h3>
                <p class="mt-1 text-indigo-200">
                    @auth
                        Senang melihat Anda lagi. Mari kita lihat aktivitas terbaru Anda.
                    @else
                        Silakan masuk untuk melihat aktivitas Anda.
                    @endauth
                </p>
            </div>
        </div>

        {{-- Statistik ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <x-stat-box icon="bxs-file-blank" color="blue" title="Lamaran Terkirim" :count="$lamaranTerkirimCount" />
            <x-stat-box icon="bxs-megaphone" color="red" title="Lowongan Diposting" :count="$lowonganDipostingCount" />
            <x-stat-box icon="bxs-certification" color="purple" title="Pelatihan Diikuti" :count="$pelatihanDiikutiCount" />
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6 text-gray-900">
                <h3 class="text-xl font-semibold mb-4">Aktivitas Terbaru Anda</h3>
                <ul class="space-y-4">
                    @forelse ($aktivitasTerbaru as $aktivitas)
                        @include('components.aktivitas-item', ['aktivitas' => $aktivitas])
                    @empty
                        <li class="text-center text-gray-500 py-4">Belum ada aktivitas terbaru.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>

    {{-- === Fitur Utama === --}}
    <section id="fitur-utama" class="py-10">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Akses Cepat ke Fitur Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.fitur-box', [
                'route' => auth()->check() ? route('lowongan.index') : route('login'),
                'icon' => 'briefcase',
                'title' => 'Lowongan Kerja Terbaru',
                'desc' => 'Temukan ribuan lowongan yang sesuai dengan keahlian Anda.',
                'color' => 'indigo'
            ])
            @include('components.fitur-box', [
                'route' => auth()->check() ? route('pelatihan.index') : route('login'),
                'icon' => 'certificate',
                'title' => 'Pelatihan & Kursus',
                'desc' => 'Tingkatkan skill dengan pelatihan gratis dan bersertifikat.',
                'color' => 'green'
            ])
            @include('components.fitur-box', [
                'route' => auth()->check() ? route('desa.digital') : route('login'),
                'icon' => 'network-wired',
                'title' => 'Jaringan Desa Digital',
                'desc' => 'Terhubung dengan komunitas desa digital dan potensi ekonomi.',
                'color' => 'yellow'
            ])
            @include('components.fitur-box', [
                'route' => auth()->check() ? route('profile.edit') : route('login'),
                'icon' => 'user-circle',
                'title' => 'Kelola Profil',
                'desc' => 'Perbarui profil Anda untuk rekomendasi yang lebih baik.',
                'color' => 'purple'
            ])
            @include('components.fitur-box', [
                'route' => auth()->check() ? route('chat.index') : route('login'),
                'icon' => 'comments',
                'title' => 'Layanan Chat',
                'desc' => 'Hubungi tim dukungan kami kapan saja Anda butuhkan.',
                'color' => 'blue'
            ])
            @include('components.fitur-box', [
                'route' => route('artikel.index'),
                'icon' => 'newspaper',
                'title' => 'Artikel & Berita',
                'desc' => 'Baca berita terbaru seputar desa digital dan dunia kerja.',
                'color' => 'orange'
            ])
        </div>
    </section>

    {{-- === Statistik Pengguna === --}}
    <section id="statistik" class="py-10 bg-white p-8 rounded-xl shadow-md mb-10">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">Statistik Pengguna VillWork</h2>
        <div id="apexChart" class="max-w-4xl mx-auto"></div>

        <div class="overflow-x-auto mt-10">
            <table class="min-w-full border border-gray-200 table-auto shadow-sm rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 border border-gray-200 text-left">Bulan</th>
                        <th class="px-6 py-3 border border-gray-200 text-left">Pengguna Baru</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ([
                        'Januari' => 120,
                        'Februari' => 200,
                        'Maret' => 340,
                        'April' => 580,
                        'Mei' => 770,
                        'Juni' => 950,
                        'Juli' => 1300
                    ] as $bulan => $jumlah)
                        <tr>
                            <td class="px-6 py-3 border border-gray-200">{{ $bulan }}</td>
                            <td class="px-6 py-3 border border-gray-200">{{ $jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- === Artikel Terbaru === --}}
    <section id="artikel" class="py-10 bg-white p-8 rounded-xl shadow-md mb-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Artikel Terbaru</h2>
            <a href="{{ route('artikel.index') }}" class="text-indigo-600 hover:underline flex items-center gap-2">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($artikelTerbaru as $artikel)
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Artikel"
                         class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-bold mb-2">{{ $artikel->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $artikel->excerpt }}</p>
                    <a href="{{ route('artikel.show', $artikel->id) }}"
                       class="text-indigo-600 text-sm hover:underline">Selengkapnya</a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- === Testimoni === --}}
    <section id="testimoni" class="bg-white py-10 p-8 rounded-xl shadow-md mb-10">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
            Kata Mereka Tentang <span class="text-indigo-600">VillWork</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($testimoni as $t)
                <div class="bg-gradient-to-br from-indigo-50 via-white to-indigo-100 p-6 rounded-xl shadow-md">
                    <img src="{{ $t->foto }}" alt="User" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 italic">"{{ $t->pesan }}"</p>
                    <p class="mt-2 font-semibold text-indigo-700">{{ $t->nama }}, {{ $t->profesi }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- === CTA Section === --}}
    <section class="bg-gray-800 text-white p-8 rounded-xl text-center mb-10">
        <h2 class="text-3xl font-bold">Siap Mengambil Langkah Selanjutnya?</h2>
        <p class="mt-4 text-gray-300 max-w-2xl mx-auto">
            Bergabunglah dan jadilah bagian dari perubahan desa digital bersama VillWork.
        </p>
        <div class="mt-8">
            <a href="{{ route('register') }}"
               class="bg-green-500 px-8 py-3 rounded-lg font-semibold hover:bg-green-600 transition-transform hover:scale-105 shadow-lg">
                Buat Akun Gratis
            </a>
        </div>
    </section>
</div>
