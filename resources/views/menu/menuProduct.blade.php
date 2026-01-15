<x-layout>
    <x-header :count="$count" />

    <div class="max-w-6xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">☕ Café Menu</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($product->avatar)
                        <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-2">₱{{ number_format($product->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            class="flex justify-center gap-2 mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach
        </div>
    </div>



</x-layout>
