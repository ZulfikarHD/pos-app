<div
	class="fixed left-0 flex h-screen w-64 -translate-x-full transform flex-col bg-gray-900 text-white transition-transform duration-300 lg:translate-x-0">
	<!-- Logo Section -->
	<div class="border-b border-gray-700 p-6 text-center text-2xl font-semibold">
		MyApp
	</div>

	<!-- Navigation Links -->
	<nav class="flex-1 space-y-2 p-4">
		<a href="{{ route('dashboard') }}"
			class="{{ request()->routeIs('dashboard') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="home" class="mr-3 h-5 w-5"></i>
			<span>Dashboard</span>
		</a>
		<a href="{{ route('orders.view') }}"
			class="{{ request()->routeIs('orders.view') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="shopping-cart" class="mr-3 h-5 w-5"></i>
			<span>Orders</span>
		</a>
		<a href="{{ route('orders.create') }}"
			class="{{ request()->routeIs('orders.create') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="plus-circle" class="mr-3 h-5 w-5"></i>
			<span>Create Order</span>
		</a>
		<a href="{{ route('orders.drafts') }}"
			class="{{ request()->routeIs('orders.drafts') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="file-text" class="mr-3 h-5 w-5"></i>
			<span>Draft Orders</span>
		</a>
		<a href="{{ route('orders.process-order') }}"
			class="{{ request()->routeIs('orders.process-orders') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="file-text" class="mr-3 h-5 w-5"></i>
			<span>Process Orders</span>
		</a>
		<a href="{{ route('packing-lists.index') }}"
			class="{{ request()->routeIs('packing-lists.index') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="file-text" class="mr-3 h-5 w-5"></i>
			<span>Packing List</span>
		</a>
		<a href="{{ route('packing-lists.generate') }}"
			class="{{ request()->routeIs('packing-lists.generate') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="file-text" class="mr-3 h-5 w-5"></i>
			<span>Generate Packing List</span>
		</a>
		<a href="{{ route('invoice.generate') }}"
			class="{{ request()->routeIs('invoice.generate') ? 'bg-gray-800' : '' }} flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="file-text" class="mr-3 h-5 w-5"></i>
			<span>Generate Invoice</span>
		</a>
		<!-- Add more links as needed -->
	</nav>

	<!-- Footer or Logout -->
	<div class="border-t border-gray-700 p-4">
		<a href="#" class="flex items-center rounded px-4 py-2 transition duration-200 hover:bg-gray-800">
			<i data-lucide="log-out" class="mr-3 h-5 w-5"></i>
			<span>Logout</span>
		</a>
	</div>
</div>
