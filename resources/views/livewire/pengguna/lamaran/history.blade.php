<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Lamaran Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0">
                <p class="text-gray-600">Lacak status semua lamaran pekerjaan yang telah Anda kirim.</p>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posisi
                                    Dilamar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perusahaan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                    Melamar</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($myApplications as $lamaran)
                                <tr wire:key="lamaran-{{ $lamaran->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $lamaran->lowongan?->judul_lowongan ?? 'Lowongan Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $lamaran->lowongan?->user?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $lamaran->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @switch($lamaran->status)
                                                @case('diterima')
                                                    bg-green-100 text-green-800
                                                    @break
                                                @case('ditolak')
                                                    bg-red-100 text-red-800
                                                    @break
                                                @default
                                                    bg-yellow-100 text-yellow-800
                                            @endswitch
                                        ">
                                            {{ ucfirst($lamaran->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Anda belum pernah mengirim lamaran apapun.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
