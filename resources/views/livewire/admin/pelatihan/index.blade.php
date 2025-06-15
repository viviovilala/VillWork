<div>
    <div class="controls">
        <a href="#">Tambah Pelatihan Baru</a>
    </div>

    <hr>

    <div class="search-filter">
        <input type="text" wire:model.live="search" placeholder="Cari nama pelatihan...">
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Poster</th>
                <th>Nama Pelatihan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelatihans as $pelatihan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $pelatihan->poster) }}" alt="{{ $pelatihan->nama_pelatihan }}" width="100">
                    </td>
                    <td>{{ $pelatihan->nama_pelatihan }}</td>
                    <td>{{ $pelatihan->tanggal_mulai->format('d M Y') }}</td>
                    <td>{{ $pelatihan->tanggal_selesai->format('d M Y') }}</td>
                    <td>
                        <button wire:click="edit({{ $pelatihan->id }})">Edit</button>
                        <button wire:click="confirmDelete({{ $pelatihan->id }})" onclick="return confirm('Anda yakin ingin menghapus pelatihan ini?')">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data pelatihan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
    </div>
</div>