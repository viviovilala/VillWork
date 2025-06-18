
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Lowongan Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-600">Temukan peluang karir terbaik yang sesuai dengan keahlian Anda.</p>
                <div class="w-full md:w-1/3 flex items-center gap-2">
                    <a href="lamaran/history" wire:navigate class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Riwayat Lamaran
                    </a>
                    <x-text-input wire:model.live.debounce.300ms="search" class="w-full" type="text" placeholder="Cari posisi, perusahaan..." />
                
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('warning'))
                 <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Peringatan</p>
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($lowongans as $lowongan)
                    <div wire:key="{{ $lowongan->id }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col">
                        <div class="p-6 flex-grow">
                            <div class="text-sm text-gray-500 font-semibold tracking-wide uppercase">{{ $lowongan->user?->name ?? 'Perusahaan' }}</div>
                            <h3 class="mt-1 text-xl leading-tight font-bold text-black">{{ $lowongan->judul_lowongan }}</h3>
                            <p class="mt-2 text-gray-600 text-sm flex-grow">{{ Str::limit($lowongan->deskripsi, 120) }}</p>
                        </div>
                        <div class="p-6 bg-gray-50 border-t border-gray-200 space-y-3">
                             <div class="flex items-center text-gray-600 text-sm"><i class='bx bxs-map mr-2 text-lg'></i><span>{{ $lowongan->lokasi }}</span></div>
                             <div class="flex items-center text-gray-600 text-sm"><i class='bx bxs-wallet mr-2 text-lg'></i><span>Rp {{ number_format($lowongan->gaji, 0, ',', '.') }}</span></div>
                        </div>
                        <div class="px-6 pb-6 pt-3 bg-gray-50">
                             <a href="{{ route('lamaran.create', $lowongan) }}" wire:navigate class="block text-center w-full bg-indigo-600 text-white px-4 py-2 text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                Lamar Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16"><p class="text-gray-500">Tidak ada lowongan pekerjaan ditemukan.</p></div>
                @endforelse
            </div>
            <div class="mt-8">{{ $lowongans->links() }}</div>
        </div>
    </div>
</div>