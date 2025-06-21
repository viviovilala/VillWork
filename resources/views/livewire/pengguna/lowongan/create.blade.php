
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publish Lowongan Pekerjaan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form wire:submit="save">
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="judul_lowongan" :value="__('Judul Posisi')" />
                                <x-text-input wire:model="judul_lowongan" id="judul_lowongan" type="text" class="mt-1 block w-full" placeholder="Contoh: Web Developer (Full-Stack)" />
                                <x-input-error :messages="$errors->get('judul_lowongan')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi Pekerjaan')" />
                                <textarea wire:model="deskripsi" id="deskripsi" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Jelaskan tanggung jawab, kualifikasi, dan detail pekerjaan lainnya."></textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="gaji" :value="__('Gaji yang Ditawarkan (per bulan)')" />
                                    <x-text-input wire:model="gaji" id="gaji" type="number" step="100000" class="mt-1 block w-full" placeholder="Contoh: 5000000" />
                                    <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="lokasi" :value="__('Tanggal Mu')" />
                                    <x-text-input wire:model="lokasi" id="lokasi" type="text" class="mt-1 block w-full" placeholder="Contoh: Jakarta, Indonesia" />
                                    <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai Bekerja')" />
                                <x-text-input wire:model="tanggal_mulai" id="tanggal_mulai" type="date" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200">
                            <x-primary-button>
                                {{ __('Publish Lowongan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>