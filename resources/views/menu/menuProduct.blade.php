<x-layout>
    <x-header :count="$count" />
    <h1 class="text-3xl font-bold mb-6 text-center">☕ Café Menu</h1>


    <div class="flex flex-col m-10 ">
        <div class="flex justify-end mb-4 sticky top-4 z-10"> <a href="{{ url('/products/create') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Add Product
            </a></div>

        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($coffee as $c)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($c->avatar)
                        <img src="{{ asset('storage/' . $c->avatar) }}" alt="{{ $c->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $c->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $c->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($c->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $c->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $c->id) }}" method="POST"
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

        <h1 class="text-3xl font-bold mb-6 text-center">☕ Non Café Menu</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($nonCoffee as $nc)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($nc->avatar)
                        <img src="{{ asset('storage/' . $nc->avatar) }}" alt="{{ $nc->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $nc->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $nc->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($nc->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $nc->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $nc->id) }}" method="POST"
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


        <h1 class="text-3xl font-bold mb-6 text-center">☕ Milky Series</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($milkySeries as $milky)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($milky->avatar)
                        <img src="{{ asset('storage/' . $milky->avatar) }}" alt="{{ $milky->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $milky->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $milky->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($milky->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $milky->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $milky->id) }}" method="POST"
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

        {{-- Snack Menu --}}


        <h1 class="text-3xl font-bold mb-6 text-center">Snack Menu</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($snackMenu as $snacks)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($snacks->avatar)
                        <img src="{{ asset('storage/' . $snacks->avatar) }}" alt="{{ $snacks->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $snacks->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $snacks->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($snacks->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $snacks->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $snacks->id) }}" method="POST"
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
        {{-- Classic Waffle --}}

        <h1 class="text-3xl font-bold mb-6 text-center">Classic Waffle</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($classicWaffle as $classic)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($classic->avatar)
                        <img src="{{ asset('storage/' . $classic->avatar) }}" alt="{{ $classic->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $classic->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $classic->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($classic->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $classic->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $classic->id) }}" method="POST"
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


        {{-- premium waffle --}}

        <h1 class="text-3xl font-bold mb-6 text-center">Premium Waffle</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-6 gap-2">

            @foreach ($premiumWaffle as $premium)
                <div class="bg-white shadow-lg rounded-lg p-4 text-center hover:shadow-xl transition">
                    @if ($premium->avatar)
                        <img src="{{ asset('storage/' . $premium->avatar) }}" alt="{{ $premium->name }}"
                            class="w-48 h-48 object-cover rounded mb-3 mx-auto">
                    @endif

                    <h2 class="text-xl font-semibold">{{ $premium->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $premium->size }}</p>
                    <p class="text-gray-600 mb-2">₱{{ number_format($premium->price, 2) }}</p>

                    <div class="flex justify-center gap-2 mt-3">
                        <div class="flex justify-center gap-2 mt-3">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('products.edit', $premium->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('products.destroy', $premium->id) }}" method="POST"
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
