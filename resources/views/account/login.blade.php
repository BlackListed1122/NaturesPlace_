<x-layout>

    <div class=" bg-gray rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 mb-12 p-8 py-12">
        <h2 class="text-center text-4xl">Login</h2>


        <form method="POST" action="{{ route('login.authenticate') }}" enctype="multipart/form-data">
            @csrf
            <x-inputs.text id="email" name="email" label="Email" />
            <x-inputs.text id="password" name="password" label="Password" />

            <button class="rounded sm bg-blue-400 w-full px-4 py-2 focus:outline-none" type="submit">Login</button>
            <p class="mt-4 text-gray-300">
                Don’t have an account?
                <a class="text-blue-900" href="{{ route('account.store') }}">Register</a>
            </p>
        </form>




    </div>
</x-layout>
