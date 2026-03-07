<x-layout>

    <x-header :count="$count" />

    <div class="flex bg-gray-100">

        <!-- Sidebar -->
        <x-side-bar />

        <!-- Main Content -->
        <div class="flex-1 p-8">

            <!-- Page Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Reports
                </h1>

                {{-- <a href="{{ url('/account/create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow
                    hover:bg-blue-700">
                    + Add User
                </a> --}}
            </div>

            <!-- User Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Id</th>
                            <th class="px-6 py-3">Summary</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach ($records as $record)
                            <tr class="">
                                <td class="px-6 py-4">{{ $record->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">{{ $record->id }}</td>
                                <td class="px-6 py-4">{!! $record->summary !!}</td>
                                <td class="px-6 py-4">₱{{ $record->total }}</td>

                                <td class="px-6 py-4">
                                    <a href="{{ route('records.show', $record->id) }}" class="text-blue-500 underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
</x-layout>
