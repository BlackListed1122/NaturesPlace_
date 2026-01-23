<x-layout>
    <h2 class="text-xl font-bold mb-4">Transaction History</h2>

    <table class="border w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>#{{ $record->id }}</td>
                    <td>₱{{ $record->total }}</td>
                    <td>
                        <a href="{{ route('records.show', $record->id) }}" class="text-blue-500 underline">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</x-layout>
