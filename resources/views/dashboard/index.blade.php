<x-layout>

    <x-header :count="$count" />

    <div class="flex h-screen bg-gray-100">
        <x-side-bar />
        <table class="border w-full">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order Id</th>
                    <th>Summary</th>
                    <th>Amount</th>

                </tr>
            </thead>
            <tbody>



            </tbody>
        </table>
    </div>
</x-layout>
