<div class="space-y-8">
    {{-- Tabel Pengguna Terbaru --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Pengguna Terbaru</h3>
            <a href="{{ route('admin.user.index') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Lihat Semua & Kelola</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at?->format('d M Y') ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Pelatihan Terbaru --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
         <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Pelatihan Terbaru</h3>
            <a href="{{ route('admin.pelatihan.index') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Lihat Semua & Kelola</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pelatihans as $pelatihan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pelatihan->nama_pelatihan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelatihan->tanggal_mulai?->format('d M Y') ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data pelatihan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- [BARU] Tabel Peserta Pelatihan Terbaru --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
           <h3 class="text-xl font-semibold">Peserta Pelatihan Terbaru</h3>
           <a href="{{ route('admin.peserta-pelatihan.index') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Lihat Semua & Kelola</a>
       </div>
       <div class="overflow-x-auto">
           <table class="min-w-full">
               <thead class="bg-gray-50">
                   <tr>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelatihan Diikuti</th>
                   </tr>
               </thead>
               <tbody class="bg-white divide-y divide-gray-200">
                   @forelse ($pesertaPelatihans as $peserta)
                       <tr>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->user?->name ?? 'N/A' }}</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $peserta->pelatihan?->nama_pelatihan ?? 'N/A' }}</td>
                       </tr>
                   @empty
                       <tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data peserta pelatihan.</td></tr>
                   @endforelse
               </tbody>
           </table>
       </div>
   </div>

    {{-- Tabel Lowongan Terbaru --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Lowongan Terbaru</h3>
            <a href="{{ route('admin.lowongan.index') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Lihat Semua & Kelola</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Lowongan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diposting Oleh</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                     @forelse ($lowongans as $lowongan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lowongan->judul_lowongan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lowongan->user?->name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data lowongan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Lamaran Terbaru --}}
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Lamaran Terbaru</h3>
            <a href="{{ route('admin.lamaran.index') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Lihat Semua & Kelola</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelamar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi Dilamar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lamarans as $lamaran)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lamaran->user?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lamaran->lowongan?->judul_lowongan ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data lamaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
