<x-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold mb-4 text-center">Create Account</h2>

        <form method="POST" action="{{ route('account.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <label class="block mb-2">Full Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Contact Number</label>
            <input type="contact_number" name="contact_number" class="w-full border p-2 rounded mb-3" required>


            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded mb-3" required>


            <x-inputs.select id="user_level" name="user_level" label="User Level" :options="[
                'Cashier' => 'Cashier',
                'Admin' => 'Admin',
            ]" />
            <x-inputs.file id="avatar" name="avatar" label="Avatar" />

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded" type="submit">
                Sign Up
            </button>
        </form>
    </div>
</x-layout>
