<x-layout>
    <x-header :count="$count" />


    {{-- 
    <x-layout>
        <div class="max-w-md mx-auto mt-10 bg-white p-6 shadow rounded">
            <h2 class="text-xl font-bold mb-4">Stored IDs</h2>

            @forelse ($record as $records)
                <p>{{ $records->id }}</p>
            @empty
                <p>no record id available</p>
            @endforelse

            <p class="mt-4 text-gray-500">Raw JSON: {{ json_encode($record->ids) }}</p>
        </div>
    </x-layout> --}}


</x-layout>
