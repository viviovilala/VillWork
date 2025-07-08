<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Artikel Desa</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artikels as $artikel)
                <a href="{{ route('artikel.show', $artikel->id) }}"
                   class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden group">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}"
                         alt="{{ $artikel->judul }}"
                         class="w-full h-48 object-cover group-hover:scale-105 transition">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 group-hover:text-indigo-600">
                            {{ $artikel->judul }}
                        </h2>
                        <p class="text-gray-600 mt-2 text-sm line-clamp-3">
                            {{ $artikel->excerpt }}
                        </p>
                        <p class="mt-4 text-gray-400 text-xs">
                            Diposting: {{ \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-3">Belum ada artikel yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
