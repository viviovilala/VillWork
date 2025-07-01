<div>
    <h3 class="text-lg font-semibold text-center mb-4">
        Chat dengan {{ $toUser->name }}<br>untuk Lowongan "{{ $lowongan->judul_lowongan }}"
    </h3>

    <div id="chat-box" class="h-64 overflow-y-auto mb-4 border rounded-lg p-3 flex flex-col space-y-2">
        @forelse($messages as $msg)
            {{-- Menggunakan $msg['from_user_id'] karena $msg sekarang adalah array --}}
            <div class="flex {{ $msg['from_user_id'] == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div
                    class="max-w-[85%] p-2 rounded-lg text-sm break-words
                        {{ $msg['from_user_id'] == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                    {{-- Akses nama pengguna melalui array relasi: $msg['from_user']['name'] --}}
                    @if ($msg['from_user_id'] != auth()->id())
                        <p class="font-bold mb-0.5">{{ $msg['from_user']['name'] ?? 'Pengguna' }}</p>
                    @endif
                    <p>{{ $msg['message'] }}</p>
                    {{-- Untuk created_at, gunakan Carbon::parse() karena ini adalah string tanggal --}}
                    <span
                        class="text-xs opacity-80 mt-0.5 block {{ $msg['from_user_id'] == auth()->id() ? 'text-right' : 'text-left' }}">
                        {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 mt-auto mb-auto">Belum ada pesan dalam obrolan ini.</p>
        @endforelse
    </div>

    <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
        <input type="text" wire:model.live="text" class="border p-2 w-full rounded-md text-sm"
            placeholder="Tulis pesan..." />
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors duration-200" {{ !$text ? 'disabled' : '' }}>Kirim</button>
    </form>
    @error('text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

    @push('scripts')
        <script>
            function scrollToBottom() {
                const chatBox = document.getElementById('chat-box');
                if (chatBox) {
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            }

            document.addEventListener('livewire:initialized', () => {
                scrollToBottom();
            });

            document.addEventListener('livewire:update', () => {
                scrollToBottom();
            });
        </script>
    @endpush
</div>