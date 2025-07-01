<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Dashboard Semua Chat</h2>

    <table class="w-full table-auto border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Dari</th>
                <th class="p-2 border">Ke</th>
                <th class="p-2 border">Pesan</th>
                <th class="p-2 border">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $chat)
                <tr>
                    <td class="border p-2">{{ $chat->fromUser->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $chat->toUser->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $chat->message }}</td>
                    <td class="border p-2">{{ $chat->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>