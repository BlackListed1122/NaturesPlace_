<x-layout>
    <x-header :count="$count" />
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">🧾 Order Summary</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('records.store') }}" method="POST">
            @csrf
            @if (count($cart) > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="p-2">Id</th>
                            <th class="p-2">Product</th>

                            <th class="p-2 text-center">Qty</th>
                            <th class="p-2 text-right">Price</th>
                            <th class="p-2 text-right">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php $total = 0; @endphp --}}
                        @foreach ($cart as $id => $item)
                            {{-- @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp --}}
                            <tr class="border-b">
                                <td class="p-2 text-center">{{ $id }}</td>
                                <td class="p-2 flex items-center gap-3">
                                    @if ($item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                            class="w-12 h-12 object-cover rounded">
                                    @endif
                                    {{ $item['name'] }}
                                </td>

                                <td class="p-2 text-center">{{ $item['quantity'] }}</td>
                                {{-- <td class="p-2 text-right">₱{{ number_format($item['price'], 2) }}</td> --}}
                                {{-- <td class="p-2 text-right">₱{{ number_format($item['subtotal']) }}</td> --}}

                                <td class="p-2 text-right"> {{ $item['price'] }}</td>
                                <td class="p-2 text-right">{{ $item['subtotal'] }}</td>
                                {{-- Subtotal: {{ $item['subtotal'] }} --}}
                                <td class="p-2 text-right">
                                    {{-- <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Remove</button>
                                    </form> --}}
                                    <button type="submit" form="remove-{{ $id }}"
                                        class="text-red-600 hover:underline">
                                        Remove
                                    </button>

                                </td>


                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <input type="hidden" name="ids[]" class="border p-2 w-full mb-3 " value="{{ $item['quantity'] }}">
                <div class="flex items-center justify-between">
                    <div>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded mt-4 block">
                            Save
                        </button>
                    </div>
                    <div>
                        <button type="submit" form="remove-all" class="text-red-600 hover:underline">
                            Clear All
                        </button>

                    </div>
        </form>

    </div>
    </form>

    <div class="text-right mt-4 text-lg font-semibold">
        total {{ $total }}
    </div>
    @foreach ($cart as $id => $item)
        <form id="remove-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
    <form id="remove-all" action="{{ route('cart.clear') }}" method="POST">
        @csrf

    </form>
@else
    <p class="text-gray-500 text-center">Your cart is empty ☕</p>
    @endif


    </div>

</x-layout>
