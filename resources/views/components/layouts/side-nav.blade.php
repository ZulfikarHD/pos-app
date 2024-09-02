<div class="bg-gray-900 text-white w-64 h-screen flex flex-col fixed left-0 transition-transform transform lg:translate-x-0 -translate-x-full duration-300">
    <!-- Logo Section -->
    <div class="p-6 text-center text-2xl font-semibold border-b border-gray-700">
        MyApp
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-800' : '' }}">
            <i data-lucide="home" class="mr-3 w-5 h-5"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('orders.view') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 transition duration-200 {{ request()->routeIs('orders.view') ? 'bg-gray-800' : '' }}">
            <i data-lucide="shopping-cart" class="mr-3 w-5 h-5"></i>
            <span>Orders</span>
        </a>
        <a href="{{ route('orders.create') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 transition duration-200 {{ request()->routeIs('orders.create') ? 'bg-gray-800' : '' }}">
            <i data-lucide="plus-circle" class="mr-3 w-5 h-5"></i>
            <span>Create Order</span>
        </a>
        <a href="{{ route('orders.drafts') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 transition duration-200 {{ request()->routeIs('orders.drafts') ? 'bg-gray-800' : '' }}">
            <i data-lucide="file-text" class="mr-3 w-5 h-5"></i>
            <span>Draft Orders</span>
        </a>
        <!-- Add more links as needed -->
    </nav>

    <!-- Footer or Logout -->
    <div class="p-4 border-t border-gray-700">
        <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 transition duration-200">
            <i data-lucide="log-out" class="mr-3 w-5 h-5"></i>
            <span>Logout</span>
        </a>
    </div>
</div>
