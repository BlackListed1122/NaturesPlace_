<x-layout>
    @props([
        'categorys' => ['Coffee', 'Non Coffee', 'Burger', 'Classic Waffle', 'Premium Waffle'],
        'sizes' => ['Small', 'Medium', 'Large'],
    ])
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <img src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}"
                    class="w-64 h-64 object-cover mx-auto rounded-lg shadow-md">
                <x-inputs.text id="name" name="name" label="Name" placeholder="Coffee" :value="old('name', $product->name)" />
                <x-inputs.text id="description" name="description" label="Description" placeholder="any"
                    :value="old('description', $product->description)" />
                <x-inputs.text id="flavor" name="flavor" label="Flavor" placeholder="chocolate" :value="old('flavor', $product->flavor)" />


                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">
                    Category
                </label>
                <select name="category" id="category"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                    :value="old('category', $product->category)">

                    @forelse ($categorys as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @empty
                        <option disabled>No categories available</option>
                    @endforelse
                </select>



                {{-- ✅ Size --}}
                <label for="size" class="block mb-2 text-sm font-medium text-gray-700">
                    Size
                </label>
                <select name="size" id="size"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                    :value="old('size', $product->size)">

                    @forelse ($sizes as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                    @empty
                        <option disabled>No categories available</option>
                    @endforelse
                </select>



                <x-inputs.text id="price" name="price" label="Price" placeholder="Enter price"
                    :value="old('price', $product->price)" />


                <x-inputs.file id="avatar" name="avatar" label="Avatar" />

                <div class="flex items-center justify-center min-h-screen bg-gray-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
                        <form>
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-700">
                                Upload Image
                            </label>

                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg p-2 mb-4"
                                onchange="previewImage(event)">

                            <!-- Image Preview -->
                            <div class="flex justify-center">
                                <img id="preview" class="hidden w-48 h-48 object-cover rounded-lg shadow"
                                    alt="Preview">
                            </div>


                        </form>
                    </div>
                </div>

                <script>
                    function previewImage(event) {
                        const input = event.target;
                        const preview = document.getElementById('preview');
                        const file = input.files[0];

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                </script>


                <button class="bg-blue-500 px-3 py-2 text-white rounded-md hover:bg-blue-600 transition" type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>

</x-layout>
