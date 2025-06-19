<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 bg-gradient-to-r from-gray-800 to-gray-600 text-white rounded-lg">
                    <h3 class="text-2xl font-bold">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-indigo-200">Senang melihat Anda lagi. Mari kita lihat aktivitas terbaru Anda.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow flex items-start space-x-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <i class='bx bxs-file-blank text-2xl'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Lamaran Terkirim</p>
                        <p class="text-2xl font-bold">{{ $lamaranTerkirimCount }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow flex items-start space-x-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">
                        <i class='bx bxs-megaphone text-2xl'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Lowongan Diposting</p>
                        <p class="text-2xl font-bold">{{ $lowonganDipostingCount }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow flex items-start space-x-4">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                        <i class='bx bxs-certification text-2xl'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pelatihan Diikuti</p>
                        <p class="text-2xl font-bold">{{ $pelatihanDiikutiCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Aktivitas Terbaru Anda</h3>
                    <ul class="space-y-4">
                        @forelse ($aktivitasTerbaru as $aktivitas)
                            @if ($aktivitas instanceof \App\Models\Lamaran)
                                <li class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full flex-shrink-0 w-12 h-12 flex items-center justify-center">
                                        <i class='bx bx-paper-plane text-xl'></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold">Anda melamar posisi "{{ $aktivitas->lowongan?->judul_lowongan ?? 'Lowongan Dihapus' }}".</p>
                                        <p class="text-sm text-gray-500">{{ $aktivitas->created_at?->diffForHumans() }}</p>
                                    </div>
                                    <a href="#" class="text-sm text-indigo-600 hover:underline">Lihat Detail</a>
                                </li>
                            @elseif ($aktivitas instanceof \App\Models\Lowongan)
                                <li class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                                    <div class="bg-red-100 text-red-600 p-3 rounded-full flex-shrink-0 w-12 h-12 flex items-center justify-center">
                                        <i class='bx bx-bullhorn text-xl'></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold">Anda memposting lowongan baru: "{{ $aktivitas->judul_lowongan }}".</p>
                                        <p class="text-sm text-gray-500">{{ $aktivitas->created_at?->diffForHumans() }}</p>
                                    </div>
                                    <a href="#" class="text-sm text-indigo-600 hover:underline">Lihat Lowongan</a>
                                </li>
                            @elseif ($aktivitas instanceof \App\Models\PesertaPelatihan)
                                <li class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full flex-shrink-0 w-12 h-12 flex items-center justify-center">
                                        <i class='bx bx-calendar-check text-xl'></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold">Anda mendaftar pada pelatihan "{{ $aktivitas->pelatihan?->nama_pelatihan ?? 'Pelatihan Dihapus' }}".</p>
                                        <p class="text-sm text-gray-500">{{ $aktivitas->created_at?->diffForHumans() }}</p>
                                    </div>
                                    <a href="#" class="text-sm text-indigo-600 hover:underline">Lihat Pelatihan</a>
                                </li>
                            @endif
                        @empty
                            <li class="text-center text-gray-500 py-4">
                                Belum ada aktivitas terbaru.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
