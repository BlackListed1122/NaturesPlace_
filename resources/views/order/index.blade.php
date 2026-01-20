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

                    <div class="flex gap-2 ">
                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <h2 class="text-xl font-semibold">{{ $product->size }}</h2>
                    </div>

                    <p class="text-gray-600 mb-2">₱{{ number_format($product->price, 2) }}</p>

                    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1"
                            class="border rounded text-center w-16 mb-2">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                            Add to Cart
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- <div class="text-center mt-8">
            <a href="{{ route('orders.index') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow">
                View Cart →
            </a>
        </div> --}}
    </div>
    {{-- Add to cart --}}





</x-layout>
