<div>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center mb-4">
             <h2 class="text-xl font-semibold">Daftar Lamaran Masuk</h2>
            <x-text-input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pelamar atau lowongan..." class="w-full md:w-1/3" />
        </div>
        {{-- ... (Struktur Tabel Mirip dengan User & Pelatihan) ... --}}
    </div>
</div>