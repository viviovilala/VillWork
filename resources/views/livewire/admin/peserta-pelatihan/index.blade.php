<div>
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-6">
        <h2 class="text-xl font-semibold mb-4">Pendaftaran Peserta (7 Hari Terakhir)</h2>
        <div >
            <canvas id="pesertaChart"></canvas>
        </div>
    </div>

    {{-- Tabel Section --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
            <h2 class="text-xl font-semibold">Daftar Peserta Pelatihan</h2>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <x-text-input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama peserta atau pelatihan..." class="w-full md:w-auto" />
                <button wire:click="exportExcel" class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                    Unduh Excel
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelatihan Diikuti</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pesertaPelatihans as $peserta)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->user?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $peserta->pelatihan?->nama_pelatihan ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $peserta->created_at?->format('d M Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="delete({{ $peserta->id }})" wire:confirm="Anda yakin ingin menghapus data ini?" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500">Tidak ada data peserta ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $pesertaPelatihans->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        const ctx = document.getElementById('pesertaChart');
        if (ctx) {
            const chartData = @json($chartData);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Jumlah Pendaftar Baru',
                        data: chartData.data,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    });
</script>
@endpush