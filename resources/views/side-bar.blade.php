<!-- Sidebar -->
<aside class="w-64 bg-white shadow-lg">


    <nav class="p-4 space-y-2">
        <a href="{{ url('/dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            <i class="fa fa-home"></i>
            <span>Overview</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            <i class="fa fa-shopping-cart"></i>
            <span>Expenses</span>
        </a>

        <a href="{{ url('/records') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            <i class="fa fa-box"></i>
            <span>Reports</span>
        </a>

        <a href="{{ url('/staff') }}"class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            <i class="fa fa-users"></i>
            <span>Staff</span>
        </a>



        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-100 text-red-600 transition">
                <i class="fa fa-sign-out"></i>Logout
            </button>
        </form>
    </nav>
</aside>
