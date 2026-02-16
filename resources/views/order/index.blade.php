<x-layout>
    <x-header :count="$count" />

    {{-- <form method="GET" action="{{ route('orders.index') }}" class="mb-4 flex gap-2 flex-wrap">

        <div class="flex justify-end">
            <div class="flex gap-2">
                <a href="{{ route('orders.index') }}"
                    class="btn px-4 py-2 border border-gray-400 text-sm mt-1 rounded-full ml-1">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('orders.index', ['category' => $category]) }}"
                        class="btn px-4 py-2 border border-gray-400 text-sm mt-1 rounded-full">
                        {{ $category }}
                    </a>
                @endforeach

            </div>

            <div class="flex gap-2 ">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="px-4 py-2 border border-gray-400 text-sm mt-1 rounded">

                <button type="submit" class="bg-indigo-600 px-4 py-2 text-white text-sm mt-1 rounded">
                    Search
                </button>

            </div>
        </div>


    </form> --}}
    <form method="GET" action="{{ route('orders.index') }}" class="mb-4 flex justify-between items-center flex-wrap">

        <!-- Categories (Left) -->
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('orders.index') }}" class="px-4 py-2 border border-gray-400 text-sm rounded-full ml-1 mt-1">
                All
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('orders.index', ['category' => $category]) }}"
                    class="px-4 py-2 border border-gray-400 text-sm rounded-full mt-1">
                    {{ $category }}
                </a>
            @endforeach
        </div>

        <!-- Search (Right) -->
        <div class="flex gap-2 mt-2 sm:mt-0 mr-1">
            <div class="px-2 py-0.5 border border-gray-400 text-sm rounded-full mt-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class=" px-2 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none text-sm" />

                <button type="submit" class="bg-indigo-600 px-2 py-1.5 text-white text-sm rounded-full">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>

    </form>

    <div class="max-w-6xl mx-auto mt-10">


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


    </div>





</x-layout>


{{-- 

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse ($products as $product)
        <div class="max-w-6xl mx-auto mt-10">


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


        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">No products found.</p>
    @endforelse
</div> --}}
