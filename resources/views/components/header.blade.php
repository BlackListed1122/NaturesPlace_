@props(['count'])
<x-layout>

    <div class="px-8 py-4 flex flex-row justify-between items-center bg-[#1B2314]">
        <div>
            <img class="w-16 h-16 rounded-full"
                src="https://scontent.fcrk2-2.fna.fbcdn.net/v/t39.30808-6/475305826_1336855697442356_3940611906688955948_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeE-wYuaIM69QRjLPBDgHqCenZ-RGgKvC8ydn5EaAq8LzAoNp526gtyB7Q2hJoHfTVEwc4yGnAIvOYB6n7faG_8-&_nc_ohc=iHh1yjYhJtcQ7kNvwHG7uSX&_nc_oc=AdkG2dYEidbQLlhlHakrAeZbxJD5-Sn0FQfVLz-iMjIPCOzXGN9xrBDeV6O7lDuzdLg&_nc_zt=23&_nc_ht=scontent.fcrk2-2.fna&_nc_gid=kff9S3alNkCq8df2oKCWaA&oh=00_AfjTojCtDQWFJcbMFMiFwMbzfWNyJdnW2QYAFs3NHW-97w&oe=692B86B7"
                alt="Nature Place">
        </div>
        <div class="flex flex-row gap-6 xl:text-lg text-white">
            <a class="" href="{{ url('/') }}">Home</a>
            <a href="{{ url('/products/create') }}">Create Products</a>
            <a href="{{ url('/orders') }}">Order</a>
            <a href="{{ url('/') }}">Order History</a>
            <div class="relative">
                <a href="{{ url('/cart') }}" class=""><i class="fa-solid fa-cart-shopping"></i></a>
                <div
                    class="absolute -top-2 -right-2 bg-red-700 rounded-full w-4.5 h-4.5 text-[10px] flex items-center justify-center">
                    {{ $count }}</div>
            </div>
        </div>
    </div>
</x-layout>
