<div>
    <div class="flex justify-between items-center mb-6">
        {{-- Menggunakan komponen tombol primer dari Breeze --}}
        <x-primary-button onclick="location.href='{{ route('admin.pelatihan.create') }}'" wire:navigate>
            {{ __('Tambah Pelatihan Baru') }}
        </x-primary-button>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-end mb-4">
            {{-- Menggunakan komponen input teks dari Breeze --}}
            <x-text-input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pelatihan..." class="w-full md:w-1/3" />
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pelatihans as $pelatihan)
                        <tr>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $pelatihan->nama_pelatihan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $pelatihan->tanggal_mulai->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pelatihan.edit', $pelatihan) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <button wire:click="delete({{ $pelatihan->id }})" wire:confirm="Anda yakin ingin menghapus pelatihan ini?" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data pelatihan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $pelatihans->links() }}
        </div>
    </div>
</div>