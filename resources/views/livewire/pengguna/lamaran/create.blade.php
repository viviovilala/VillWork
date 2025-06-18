<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kirim Lamaran untuk Posisi: <span class="text-indigo-600">{{ $lowongan->judul_lowongan }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800">Detail Lowongan</h3>
                        <p class="mt-1 text-gray-600">Anda akan melamar sebagai <span
                                class="font-semibold">{{ $lowongan->judul_lowongan }}</span> di <span
                                class="font-semibold">{{ $lowongan->user->name ?? 'Perusahaan' }}</span>.</p>
                    </div>

                    <form wire:submit="save">
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="pesan" :value="__('Pesan atau Surat Lamaran Singkat')" />
                                <textarea wire:model="pesan" id="pesan" rows="8"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Tulis pesan singkat kepada perekrut. Jelaskan mengapa Anda adalah kandidat yang tepat untuk posisi ini."></textarea>
                                <x-input-error :messages="$errors->get('pesan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 gap-4">
                            <a href="lamaran" wire:navigate class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Batal
                            </a>
                            <form wire:submit.prevent="save">
                                <x-primary-button type="submit">
                                    {{ __('Kirim Lamaran') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
