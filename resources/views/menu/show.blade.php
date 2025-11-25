<x-layout>
    <div class="rounded-lg  bg-white p-4">

        <div class="max-w-lg mx-auto bg-white rounded-lg p-4 mt-10 ">
            <a href="{{ route('products.index') }}"
                class="fixed top-4 left-4 text-gray-400 px-4 py-2 rounded hover:bg-gray-100 shadow-xl border-[0.5px] border-gray-100 rounded-full">
                ←
            </a>
            {{-- Product Image --}}
            @if ($product->avatar)
                <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                    class="w-64 h-64 object-cover mx-auto rounded-lg shadow-md">
            @endif

            {{-- Product Name --}}
            <h1 class="text-2xl font-bold mb-2 mt-10">{{ $product->name }}</h1>

            <p class="text-gray-600 mb-4">{{ $product->description }}</p>

            {{-- Product Info --}}

            <p class="text-gray-600 mb-1 mt-6"><strong>Category:</strong> {{ $product->category }}</p>
            <p class="text-gray-600 mb-1"><strong>Flavor:</strong> {{ $product->flavor }}</p>
            <p class="text-gray-600 mb-1"><strong>Size:</strong> {{ $product->size }}</p>
            <p class="text-gray-600 mb-3"><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 mt-6">


                {{-- Edit Button --}}
                <a href="{{ route('products.edit', $product->id) }}"
                    class="flex-1 text-center bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition">
                    Edit
                </a>

                {{-- Delete Button --}}
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition"
                        onclick="return confirm('Are you sure you want to delete this product?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
