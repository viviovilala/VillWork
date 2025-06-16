<div>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <form wire:submit="save" class="space-y-6">
            {{-- Nama Pelatihan --}}
            <div>
                <x-input-label for="nama_pelatihan" :value="__('Nama Pelatihan')" />
                <x-text-input id="nama_pelatihan" wire:model="nama_pelatihan" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nama_pelatihan')" class="mt-2" />
            </div>

            {{-- Deskripsi --}}
            <div>
                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                <textarea id="deskripsi" wire:model="deskripsi" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>

            {{-- Poster Pelatihan --}}
            <div>
                <x-input-label for="poster" :value="__('Poster Pelatihan')" />
                <input type="file" id="poster" wire:model="poster" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <div wire:loading wire:target="poster" class="text-sm text-gray-500 mt-1">Mengunggah...</div>
                <x-input-error :messages="$errors->get('poster')" class="mt-2" />

                @if ($poster)
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700">Pratinjau Gambar Baru:</p>
                        <img src="{{ $poster->temporaryUrl() }}" class="w-48 h-auto mt-2 rounded">
                    </div>
                @elseif ($existingPoster)
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700">Poster Saat Ini:</p>
                        <img src="{{ asset('storage/' . $existingPoster) }}" class="w-48 h-auto mt-2 rounded">
                    </div>
                @endif
            </div>

            {{-- Tanggal Mulai dan Selesai --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
                    <x-text-input id="tanggal_mulai" wire:model="tanggal_mulai" type="date" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                    <x-text-input id="tanggal_selesai" wire:model="tanggal_selesai" type="date" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-4">
                <x-primary-button>
                    {{ __('Simpan Pelatihan') }}
                </x-primary-button>

                <a href="{{ route('admin.pelatihan.index') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Batal') }}
                </a>
            </div>
        </form>
    </div>
</div>