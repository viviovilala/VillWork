<div class="p-6 max-w-5xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 col-span-2">Publish Lowongan</h2>

        @if ($formMessage)
            <div class="p-3 mb-4 rounded-md text-sm col-span-2
                {{ $formMessageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $formMessage }}
            </div>
        @endif

        <form wire:submit.prevent="publishLowongan" class="grid grid-cols-1 md:grid-cols-2 gap-4 col-span-2">
            <div>
                <input wire:model.blur="id_perusahaan" type="text" placeholder="ID Perusahaan"
                       class="border p-2 rounded w-full @error('id_perusahaan') border-red-500 @enderror" />
                @error('id_perusahaan') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <input wire:model.blur="judul_pekerjaan" type="text" placeholder="Judul Pekerjaan"
                       class="border p-2 rounded w-full @error('judul_pekerjaan') border-red-500 @enderror" />
                @error('judul_pekerjaan') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1 md:col-span-2">
                <textarea wire:model.blur="deskripsi" rows="4" placeholder="Deskripsi pekerjaan"
                          class="border p-2 rounded w-full @error('deskripsi') border-red-500 @enderror"></textarea>
                @error('deskripsi') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1 md:col-span-2">
                <input wire:model.blur="lokasi" type="text" placeholder="Lokasi Pekerjaan"
                       class="border p-2 rounded w-full @error('lokasi') border-red-500 @enderror" />
                @error('lokasi') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <input wire:model.blur="gaji_min" type="number" placeholder="Gaji Minimal"
                       class="border p-2 rounded w-full @error('gaji_min') border-red-500 @enderror">
                @error('gaji_min') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <input wire:model.blur="gaji_max" type="number" placeholder="Gaji Maximal"
                       class="border p-2 rounded w-full @error('gaji_max') border-red-500 @enderror">
                @error('gaji_max') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1 md:col-span-2">
                <input wire:model.blur="tanggal_berakhir" type="date"
                       class="border p-2 rounded w-full @error('tanggal_berakhir') border-red-500 @enderror">
                @error('tanggal_berakhir') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded col-span-1 md:col-span-2">
                Publish Lowongan
            </button>
        </form>
    </div>

    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Data Lowongan</h2>

    @if ($lowongans->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($lowongans as $row)
                <div class="bg-white rounded-lg p-4 shadow hover:shadow-lg cursor-pointer"
                     wire:click="showDetail({{ $row->id_lowongan }})">
                    <h3 class="font-bold text-blue-900">{{ htmlspecialchars($row->judul_pekerjaan) }}</h3>
                    <p class="text-gray-600 text-sm">{{ htmlspecialchars($row->lokasi) }}</p>
                    <p class="text-green-700 font-semibold text-sm">
                        Rp{{ number_format($row->gaji_min, 0, ',', '.') }} - Rp{{ number_format($row->gaji_max, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-500 text-sm">{{ htmlspecialchars($row->tanggal_berakhir) }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-gray-600">Belum ada lowongan.</div>
    @endif

    <h2 class="text-2xl font-semibold mb-4 mt-8 text-gray-800">Grafik Gaji Lowongan</h2>
    <div class="bg-white p-6 rounded-lg shadow mb-10">
        <canvas id="lowonganChart" height="100"></canvas>
    </div>

    <div class="text-center mb-4">
        <a href="{{ route('export.lowongan') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Download Laporan CSV
        </a>
    </div>

    @if ($showDetailModal && $selectedLowongan)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
                <button wire:click="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-xl">&times;</button>
                <h3 class="text-xl font-bold mb-4">Detail Lowongan</h3>
                <p><strong>Perusahaan:</strong> {{ htmlspecialchars($selectedLowongan->id_perusahaan) }}</p>
                <p><strong>Judul Pekerjaan:</strong> {{ htmlspecialchars($selectedLowongan->judul_pekerjaan) }}</p>
                <p><strong>Deskripsi:</strong> {{ htmlspecialchars($selectedLowongan->deskripsi) }}</p>
                <p><strong>Lokasi:</strong> {{ htmlspecialchars($selectedLowongan->lokasi) }}</p>
                <p><strong>Gaji:</strong> Rp{{ number_format($selectedLowongan->gaji_min, 0, ',', '.') }} - Rp{{ number_format($selectedLowongan->gaji_max, 0, ',', '.') }}</p>
                <p><strong>Tanggal Berakhir:</strong> {{ \Carbon\Carbon::parse($selectedLowongan->tanggal_berakhir)->toLocaleDateString('id-ID') }}</p>
            </div>
        </div>
    @endif

    <script>
        let lowonganChartInstance = null;

        document.addEventListener('livewire:initialized', () => {
            // Event listener untuk data grafik yang diperbarui
            Livewire.on('lowonganDataUpdated', (data) => {
                // Pastikan data yang diterima adalah array tunggal (dari data[0])
                const chartData = data[0];

                if (lowonganChartInstance) {
                    lowonganChartInstance.data.labels = chartData.labels;
                    lowonganChartInstance.data.datasets[0].data = chartData.dataGaji;
                    lowonganChartInstance.update();
                } else {
                    const ctx = document.getElementById('lowonganChart').getContext('2d');
                    lowonganChartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                label: 'Gaji Maksimum (Rp)',
                                data: chartData.dataGaji,
                                backgroundColor: '#1e3a8a'
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
</div>