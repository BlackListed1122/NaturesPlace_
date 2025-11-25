@props(['product'])
<div>
    <div class="rounded-lg shadow-lg bg-white p-4 border-[0.5px] border-gray-100">
        <a href="{{ route('products.show', $product->id) }}">
            <div class="flex items-center space-between gap-4 w-64 mx-auto bg-white p-4 rounded ">

                <div>

                    @if ($product->avatar)
                        <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                            class="w-64 h-64 object-cover mx-auto rounded-lg shadow-md">
                    @endif
                    <h2 class="text-xl font-semibold text-center mt-4">
                        {{ $product->name }}
                    </h2>

                </div>
            </div>

    </div>
    </a>
</div>
