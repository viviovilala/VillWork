
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Lowongan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <!-- Session Messages -->
            @if (session('status_success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ session('status_success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- [KOLOM KIRI] Daftar Lowongan yang Anda Posting -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-28">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Lowongan Anda</h3>
                        <ul class="space-y-3">
                            @forelse ($myLowongans as $lowongan)
                                <li wire:key="lowongan-{{ $lowongan->id }}">
                                    <button wire:click="viewApplicants({{ $lowongan->id }})" class="w-full text-left p-4 rounded-lg transition-colors {{ $selectedLowongan && $selectedLowongan->id == $lowongan->id ? 'bg-indigo-100' : 'hover:bg-gray-100' }}">
                                        <p class="font-semibold text-gray-900">{{ $lowongan->judul_lowongan }}</p>
                                        <p class="text-sm text-gray-500">{{ $lowongan->lamarans_count }} Pelamar</p>
                                    </button>
                                </li>
                            @empty
                                <li class="text-center text-gray-500 py-4">
                                    <p>Anda belum memposting lowongan apapun.</p>
                                    <a href="{{ route('lowongan.create') }}" wire:navigate class="text-indigo-600 hover:underline mt-2 inline-block">Publish sekarang</a>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- [KOLOM KANAN] Daftar Pelamar -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md">
                        @if ($selectedLowongan)
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-bold text-gray-800">Daftar Pelamar untuk:</h3>
                                <p class="text-xl font-semibold text-indigo-600">{{ $selectedLowongan->judul_lowongan }}</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelamar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse ($applicants as $lamaran)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <p class="text-sm font-medium text-gray-900">{{ $lamaran->user?->name ?? 'N/A' }}</p>
                                                    <p class="text-sm text-gray-500">{{ $lamaran->user?->email ?? 'N/A' }}</p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $lamaran->status == 'diterima' ? 'bg-green-100 text-green-800' : ($lamaran->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                        {{ ucfirst($lamaran->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                    <button wire:click="updateStatus({{ $lamaran->id }}, 'diterima')" class="text-green-600 hover:text-green-900" title="Terima Lamaran">
                                                        <i class='bx bx-check-circle text-xl'></i>
                                                    </button>
                                                    <button wire:click="updateStatus({{ $lamaran->id }}, 'ditolak')" class="text-red-600 hover:text-red-900" title="Tolak Lamaran">
                                                        <i class='bx bx-x-circle text-xl'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">Belum ada pelamar untuk lowongan ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center text-gray-500">
                                <i class='bx bx-list-ul text-4xl mb-3'></i>
                                <p>Pilih lowongan di sebelah kiri untuk melihat daftar pelamarnya.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>