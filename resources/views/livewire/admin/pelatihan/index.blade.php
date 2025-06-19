<div class="space-y-8">
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- [PERBAIKAN] Area Chart Data --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-6">
        <h2 class="text-xl font-semibold mb-4">Pelatihan Dibuat (7 Hari Terakhir)</h2>
        {{-- Container diberi tinggi tetap agar ukuran chart konsisten --}}
        <div >
            <canvas id="pelatihanChart"></canvas>
        </div>
    </div>

    {{-- Area Tabel Data --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
            <h2 class="text-xl font-semibold">Daftar Pelatihan</h2>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <x-text-input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama pelatihan..." class="w-full md:w-auto" />
                <button wire:click="exportExcel" class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition">
                    Unduh Excel
                </button>
                <a href="{{ route('admin.pelatihan.create') }}" wire:navigate class="flex-shrink-0 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                    Tambah Baru
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pelatihans as $pelatihan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pelatihan->nama_pelatihan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelatihan->tanggal_mulai?->format('d M Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pelatihan.edit', $pelatihan) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
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
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        const chartData = @json($chartData); // Nama variabel disamakan

        const canvas = document.getElementById('pelatihanChart');
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Jumlah Pelatihan',
                        data: chartData.data,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)', // Typo diperbaiki
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
                }
            });
        
    });
</script>
@endpush