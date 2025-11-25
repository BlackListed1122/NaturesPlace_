<x-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold mb-4 text-center">Create Account</h2>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Full Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded mb-3" required>

            <label class="block mb-2">User Level</label>
            <select name="user_level" class="w-full border p-2 rounded mb-4">
                <option value="cashier">Cashier</option>
                <option value="admin">Admin</option>
            </select>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded">
                Sign Up
            </button>
        </form>
    </div>
</x-layout>
