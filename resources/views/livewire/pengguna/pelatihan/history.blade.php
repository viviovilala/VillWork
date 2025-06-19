<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pelatihan Saya') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mb-6 px-4 sm:px-0 flex justify-between items-center">
            <p class="text-gray-600">Berikut adalah daftar semua pelatihan yang sedang dan pernah Anda ikuti.</p>
            <a href="{{ route('pelatihan.index') }}" wire:navigate
                class="flex-shrink-0 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-sm font-semibold transition-colors">
                Daftar Pelatihan
            </a>
        </div>
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @forelse ($pelatihanTerdaftar as $pendaftaran)
                    <li wire:key="pendaftaran-{{ $pendaftaran->id }}"
                        class="p-4 sm:p-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4 hover:bg-gray-50 transition-colors">
                        <div>
                            <p class="font-bold text-lg text-indigo-700">
                                {{ $pendaftaran->pelatihan?->nama_pelatihan ?? 'Pelatihan tidak ditemukan' }}</p>
                            <p class="mt-2 text-gray-500 text-sm flex-grow">
                                {{ Str::limit($pendaftaran->pelatihan->deskripsi, 120) }}
                            </p>
                            <p class="text-sm text-gray-500">Terdaftar pada:
                                {{ $pendaftaran->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <button wire:click="batalDaftar({{ $pendaftaran->id }})"
                                wire:confirm="Anda yakin ingin membatalkan pendaftaran dari pelatihan ini?"
                                class="bg-red-100 text-red-700 w-full sm:w-auto px-4 py-2 text-sm font-semibold rounded-lg hover:bg-red-200 transition-colors">
                                Batal Daftar
                            </button>
                        </div>
                    </li>
                @empty
                    <li class="p-6 text-center text-gray-500">
                        Anda belum terdaftar di pelatihan manapun.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
</div>
