
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lowongan yang Saya Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-600">Kelola lowongan yang telah Anda publish dan lihat siapa saja yang melamar.</p>
                <div class="w-full md:w-auto flex items-center gap-2">
                    <x-text-input wire:model.live.debounce.300ms="search" class="w-full" type="text" placeholder="Cari lowongan Anda..." />
                    
                    <a href="lowongan/create" wire:navigate class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Tambah Lowongan
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Lowongan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah Pelamar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Posting</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($myLowongans as $lowongan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lowongan->judul_lowongan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lowongan->lokasi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $lowongan->lamarans_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lowongan->created_at?->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="lowongan/history" wire:navigate class="text-indigo-600 hover:text-indigo-900">Kelola Pelamar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Anda belum memposting lowongan apapun.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-8">{{ $myLowongans->links() }}</div>
        </div>
    </div>
</div>