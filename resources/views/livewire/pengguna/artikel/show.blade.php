<div class="py-16 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            {{ $artikel->judul }}
        </h1>
        <p class="text-sm text-gray-500 mb-6">
            Diposting: {{ \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') }}
        </p>
        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="gambar artikel"
            class="w-full h-72 object-cover rounded-lg mb-6">
        <div class="prose max-w-none">
            {!! $artikel->isi !!}
        </div>
    </div>
</div>