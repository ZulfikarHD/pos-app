<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Edit Packing List #{{ $packingList->id }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="savePackingList">
        <!-- Packing List Items -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Items</h2>
            <table class="w-full bg-white rounded shadow overflow-x-auto">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Product</th>
                        <th class="py-2 px-4">Quantity</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $index => $item)
                        <tr>
                            <td class="py-2 px-4">
                                <select wire:model="orderItems.{{ $index }}.product_id" class="border border-gray-300 p-2 rounded w-full">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ $product->id == $item['product_id'] ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-2 px-4">
                                <input type="number" wire:model="orderItems.{{ $index }}.quantity" min="1" class="border border-gray-300 p-2 rounded w-full">
                            </td>
                            <td class="py-2 px-4">
                                <button type="button" wire:click="removeItem({{ $index }})" class="text-red-500 hover:underline">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" wire:click="addItem" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Add Item</button>
        </div>

        <!-- Shipping Status and Tracking Details -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Shipping Details</h2>

            <div class="mb-4">
                <label class="block text-gray-700">Shipping Status</label>
                <select wire:model="shippingStatus" class="border border-gray-300 p-2 rounded w-full">
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tracking Details</label>
                <textarea wire:model="trackingDetails" class="border border-gray-300 p-2 rounded w-full" rows="4"></textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Packing List</button>
    </form>
</div>
