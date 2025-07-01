<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard Chat (Admin)</h2>

    <table class="w-full table-auto border">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Dari</th>
                <th class="border px-4 py-2">Ke</th>
                <th class="border px-4 py-2">Pesan</th>
                <th class="border px-4 py-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chats as $chat)
                <tr>
                    <td class="border px-4 py-2">{{ $chat->fromUser->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $chat->toUser->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $chat->message }}</td>
                    <td class="border px-4 py-2">{{ $chat->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>