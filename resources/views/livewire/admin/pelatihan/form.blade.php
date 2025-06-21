<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pelatihan->exists ? 'Edit Pelatihan' : 'Buat Pelatihan Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form wire:submit="save" class="space-y-6">
                        <div>
                            <x-input-label for="nama_pelatihan" :value="__('Nama')" />
                            <x-text-input id="nama_pelatihan" wire:model="nama_pelatihan" type="text"
                                class="mt-1 block w-full" placeholder="Contoh: Belajar Laravel dari Dasar" />
                            <x-input-error :messages="$errors->get('nama_pelatihan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" wire:model="deskripsi" rows="5"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                placeholder="Jelaskan detail tentang pelatihan ini..."></textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
                                <x-text-input id="tanggal_mulai" wire:model="tanggal_mulai" type="date"
                                    class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                                <x-text-input id="tanggal_selesai" wire:model="tanggal_selesai" type="date"
                                    class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>

                            <a href="{{ route('admin.pelatihan.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
