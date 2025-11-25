@props(['product'])
<x-layout>
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 mt-10 text-center">

        {{-- Product Image --}}
        @if ($product->avatar)
            <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                class="w-64 h-64 object-cover rounded-lg mx-auto mb-4 shadow">
        @endif

        {{-- Product Info --}}
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-1"><strong>Category:</strong> {{ $product->category }}</p>
        <p class="text-gray-600 mb-1"><strong>Flavor:</strong> {{ $product->flavor }}</p>
        <p class="text-gray-600 mb-3"><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>

        <p class="text-gray-700 mb-6">{{ $product->description }}</p>

        {{-- Buttons --}}
        <div class="flex justify-center gap-4">
            {{-- Back --}}
            <a href="{{ route('pages.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm">
                ← Back
            </a>

            {{-- Order Button --}}
            <button onclick="document.getElementById('orderModal').classList.remove('hidden')"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                🛒 Order Now
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <div id="orderModal" class="hidden fixed inset-0 bg-trasnparent bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-sm shadow-lg text-center relative">

            <button onclick="document.getElementById('orderModal').classList.add('hidden')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-lg">✕</button>

            <h2 class="text-xl font-semibold mb-4">Order {{ $product->name }}</h2>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Quantity --}}
                <label class="block mb-2 font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" value="1" min="1"
                    class="w-full border border-gray-300 rounded-lg p-2 text-center mb-4 focus:ring focus:ring-green-300">

                {{-- Total (Dynamic Display) --}}
                <p class="text-gray-600 mb-4">
                    Total: ₱<span id="total">{{ number_format($product->price, 2) }}</span>
                </p>

                {{-- Submit --}}
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg w-full shadow-md transition">
                    Confirm Order
                </button>
            </form>
        </div>
    </div>

    {{-- JS for live total update --}}
    <script>
        const price = {{ $product->price }};
        const quantityInput = document.querySelector('input[name="quantity"]');
        const totalSpan = document.getElementById('total');

        quantityInput.addEventListener('input', () => {
            const qty = parseInt(quantityInput.value) || 1;
            totalSpan.textContent = (price * qty).toFixed(2);
        });
    </script>
</x-layout>
