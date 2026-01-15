<x-layout>
    @props([
        'categorys' => ['Coffee', 'Non Coffee', 'Milky Series', 'Snack Menu', 'Classic Waffle', 'Premium Waffle'],
        'sizes' => ['Small', 'Medium', 'Large'],
    ])
    <x-header :count="$count" />

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <x-inputs.text id="name" name="name" label="Name" placeholder="Coffee" />
                <x-inputs.text id="description" name="description" label="Description" placeholder="any" />
                <x-inputs.text id="flavor" name="flavor" label="Flavor" placeholder="chocolate" />


                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">
                    Category
                </label>
                <select name="category" id="category"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">

                    @forelse ($categorys as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @empty
                        <option disabled>No categories available</option>
                    @endforelse
                </select>



                {{-- <div x-data="{ otherSelected: false }">

                    <label for="category">Category</label>
                    <select name="category" id="category" class="border p-2 w-full"
                        x-on:change="otherSelected = ($event.target.value === 'other')">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>

                    <!-- This input only appears when "Other" is selected -->
                    <div x-show="otherSelected" class="mt-2">
                        <label for="custom_category">Enter custom category</label>
                        <input type="text" name="custom_category" id="custom_category" class="border p-2 w-full"
                            placeholder="Your category...">
                    </div>

                </div> --}}




                {{-- ✅ Size --}}
                <label for="size" class="block mb-2 text-sm font-medium text-gray-700">
                    Size
                </label>
                <select name="size" id="size"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">

                    @forelse ($sizes as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                    @empty
                        <option disabled>No categories available</option>
                    @endforelse
                </select>



                <x-inputs.text id="price" name="price" label="Price" placeholder="Enter price" />
                <x-inputs.file id="avatar" name="avatar" label="Avatar" />

                <button class="bg-blue-500 px-3 py-2 text-white rounded-md hover:bg-blue-600 transition" type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>

</x-layout>
