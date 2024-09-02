<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">View Packing Lists</h1>

    <!-- Filters -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Filters</h2>
        <div class="flex flex-wrap space-x-4">
            <!-- Search -->
            <div class="mb-4">
                <label class="block text-gray-700">Search</label>
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Order ID or Customer" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Order ID Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Order ID</label>
                <input type="text" wire:model="filterOrderId" placeholder="Filter by Order ID" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Customer Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Customer Name</label>
                <input type="text" wire:model="filterCustomer" placeholder="Filter by Customer" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Date From Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Packing Date From</label>
                <input type="date" wire:model="filterDateFrom" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Date To Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Packing Date To</label>
                <input type="date" wire:model="filterDateTo" class="border border-gray-300 p-2 rounded">
            </div>
        </div>
    </div>

    <!-- Packing Lists Table -->
    <div class="bg-white p-4 rounded shadow">
        <table class="w-full bg-white rounded shadow overflow-x-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4">Packing List ID</th>
                    <th class="py-2 px-4">Order ID</th>
                    <th class="py-2 px-4">Customer</th>
                    <th class="py-2 px-4">Packing Date</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packingLists as $packingList)
                    <tr>
                        <td class="py-2 px-4">{{ $packingList->id }}</td>
                        <td class="py-2 px-4">{{ $packingList->order->order_id }}</td>
                        <td class="py-2 px-4">{{ $packingList->order->customer->name }}</td>
                        <td class="py-2 px-4">{{ $packingList->packing_date->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('packing-lists.edit', $packingList->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            |
                            <a href="{{ route('packing-lists.show', $packingList->id) }}" class="text-blue-500 hover:underline">View</a>
                            |
                            <a href="{{ route('packing-lists.export', $packingList->id) }}" class="text-green-500 hover:underline">Export</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-2 px-4 text-center">No packing lists found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $packingLists->links() }}
        </div>
    </div>
</div>
