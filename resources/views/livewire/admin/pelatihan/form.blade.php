<div>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

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

            {{-- BLOK UNTUK POSTER SUDAH DIHAPUS SEPENUHNYA --}}

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