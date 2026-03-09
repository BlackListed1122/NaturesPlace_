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
                    User Management
                </h1>

                <a href="{{ url('/account/create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow
                    hover:bg-blue-700">
                    + Add User
                </a>
            </div>

            <!-- User Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $user->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->user_level }}
                                </td>

                                <td class="px-6 py-4 flex justify-center gap-3">

                                    <!-- Edit -->
                                    <a href="#"
                                        class="px-3 py-1 text-sm bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('account.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-layout>
