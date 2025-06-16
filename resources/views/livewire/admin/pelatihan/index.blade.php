<div class="space-y-8">
    
    {{-- Area Grafik --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Grafik Total Pelatihan Dibuat (Per Hari)</h3>
        <div wire:ignore>
            <canvas id="pelatihanChart"></canvas>
        </div>
    </div>

    {{-- Area Tabel Data --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
             <h2 class="text-xl font-semibold">Daftar Pelatihan</h2>
            <div class="flex items-center space-x-2">
                <x-text-input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari..." class="w-full sm:w-64" />
                 <a href="{{ route('admin.pelatihan.create') }}" wire:navigate class="flex-shrink-0 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                    Tambah Baru
                </a>
                <button wire:click="export" class="flex-shrink-0 bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 text-sm">Download Excel</button>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelatihan->tanggal_mulai->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pelatihan.edit', $pelatihan) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                {{-- Anda bisa menambahkan tombol hapus di sini --}}
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
{{-- INI BAGIAN YANG DIPERBAIKI --}}
<script src="[https://cdn.jsdelivr.net/npm/chart.js](https://cdn.jsdelivr.net/npm/chart.js)"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        const initialData = @json($initialChartData);
        const canvasElement = document.getElementById('pelatihanChart');

        if (canvasElement) {
            const ctx = canvasElement.getContext('2d');
            const pelatihanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: initialData.labels,
                    datasets: [{
                        label: 'Pelatihan Baru',
                        data: initialData.data,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                    responsive: true,
                }
            });
        }
    });
</script>
@endpush
