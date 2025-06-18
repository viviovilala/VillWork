<div>
    <x-slot name="header">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pelatihan') }}
        </h2></p>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Info -->
            <div class="mb-6 px-4 sm:px-0 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-600">Temukan dan daftar pada pelatihan untuk meningkatkan skill Anda.</p>
                <a href="pelatihan/history" wire:navigate
                    class="flex-shrink-0 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                    Riwayat Pelatihan
                </a>
                <div class="w-full md:w-1/3">
                    <x-text-input wire:model.live.debounce.300ms="search" class="w-full" type="text"
                        placeholder="Cari pelatihan..." />
                </div>
            </div>

            <!-- Session Messages -->
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

            <!-- Training Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($pelatihans as $pelatihan)
                    <div wire:key="{{ $pelatihan->id }}"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col">
                        <div class="p-6 flex-grow">
                            <div class="text-sm text-indigo-700 font-semibold tracking-wide uppercase">VillWork</div>
                            <h3 class="mt-1 text-xl leading-tight font-bold text-black">{{ $pelatihan->nama_pelatihan }}
                            </h3>
                            <p class="mt-2 text-gray-500 text-sm flex-grow">
                                {{ Str::limit($pelatihan->deskripsi, 120) }}
                            </p>
                        </div>
                        <div class="p-6 bg-gray-50 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-600">
                                    <i class='bx bx-calendar-alt mr-1'></i>
                                    Mulai: {{ $pelatihan->tanggal_mulai?->format('d M Y') ?? 'N/A' }}
                                </p>
                                <button wire:click="daftar({{ $pelatihan->id }})"
                                    wire:confirm="Anda yakin ingin mendaftar pada pelatihan '{{ $pelatihan->nama_pelatihan }}'?"
                                    class="bg-gray-800 text-white px-4 py-2 text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                        <p class="text-gray-500">Tidak ada pelatihan ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $pelatihans->links() }}
            </div>
        </div>
    </div>
</div>
