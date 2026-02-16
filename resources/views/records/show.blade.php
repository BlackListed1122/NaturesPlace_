<x-layout>


    <x-header :count="$count" />
    <table class="border w-full mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['size'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['subtotal'] }}</td>

                </tr>
            @endforeach
            <td>Total : {{ $record->total }}</td>
        </tbody>
    </table>
</x-layout>
