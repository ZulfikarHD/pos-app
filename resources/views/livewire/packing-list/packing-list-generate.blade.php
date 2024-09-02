<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Generate Packing List</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full bg-white rounded shadow overflow-x-auto">
        <thead>
            <tr>
                <th class="py-2 px-4">Order ID</th>
                <th class="py-2 px-4">Customer</th>
                <th class="py-2 px-4">Items</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="py-2 px-4">{{ $order->order_id }}</td>
                    <td class="py-2 px-4">{{ $order->customer->name }}</td>
                    <td class="py-2 px-4">{{ $order->orderItems->count() }}</td>
                    <td class="py-2 px-4">
                        <button class="bg-blue-500 text-white py-2 px-4 rounded" wire:click="generatePackingList({{ $order->id }})">
                            Generate
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
