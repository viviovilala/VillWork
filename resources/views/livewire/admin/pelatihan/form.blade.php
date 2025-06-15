<div>
    {{-- Form ini akan memanggil method 'save' di komponen saat disubmit --}}
    <form wire:submit="save">
        <div>
            <label for="nama_pelatihan">Nama Pelatihan</label>
            <input type="text" id="nama_pelatihan" wire:model="nama_pelatihan">
            @error('nama_pelatihan') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" wire:model="deskripsi" rows="5"></textarea>
            @error('deskripsi') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="poster">Poster Pelatihan (Gambar)</label>
            <input type="file" id="poster" wire:model="poster">
            @error('poster') <span>{{ $message }}</span> @enderror

            {{-- Preview gambar jika sedang mode edit atau setelah memilih file --}}
            @if ($poster)
                <p>Preview:</p>
                <img src="{{ $poster->temporaryUrl() }}" width="200">
            @elseif ($existingPoster)
                 <p>Poster Saat Ini:</p>
                <img src="{{ asset('storage/' . $existingPoster) }}" width="200">
            @endif
        </div>

        <div>
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" wire:model="tanggal_mulai">
            @error('tanggal_mulai') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" wire:model="tanggal_selesai">
            @error('tanggal_selesai') <span>{{ $message }}</span> @enderror
        </div>

        <hr>

        <div>
            <button type="submit">Simpan Pelatihan</button>
            <button type="button" wire:click="cancel">Batal</button>
        </div>
    </form>
</div>