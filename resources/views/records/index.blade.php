<x-layout>

    <x-header :count="$count" />
    <div class="flex h-screen bg-gray-100">
        <x-side-bar />
        <table class="border w-full">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order Id</th>
                    <th>Summary</th>
                    <th>Amount</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->created_at->format('Y-m-d') }}</td>
                        <td>{{ $record->id }}</td>
                        <td>{!! $record->summary !!}</td>
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
    </div>
</x-layout>
