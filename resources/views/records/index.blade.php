<x-layout>
    {{-- <h1>Transaction #{{ $record->id }}</h1> --}}

    <table class="border w-full mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['subtotal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
