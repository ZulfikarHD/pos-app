<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Process Orders</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Batch Processing -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Batch Processing</h2>
        <form wire:submit.prevent="batchUpdateStatus">
            <div class="flex items-center space-x-4">
                <select wire:model="selectedStatus" class="border border-gray-300 p-2 rounded">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Status</button>
            </div>

            <table class="w-full bg-white rounded shadow overflow-x-auto mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4"><input type="checkbox" wire:model="selectAll"></th>
                        <th class="py-2 px-4">Order ID</th>
                        <th class="py-2 px-4">Customer</th>
                        <th class="py-2 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="py-2 px-4">
                                <input type="checkbox" wire:model="selectedOrders" value="{{ $order->id }}">
                            </td>
                            <td class="py-2 px-4">{{ $order->order_id }}</td>
                            <td class="py-2 px-4">{{ $order->customer->name }}</td>
                            <td class="py-2 px-4">{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>

    <!-- Order Logs -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Order Logs</h2>
        <table class="w-full bg-white rounded shadow overflow-x-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4">Order ID</th>
                    <th class="py-2 px-4">User</th>
                    <th class="py-2 px-4">Action</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @foreach ($order->logs as $log)
                        <tr>
                            <td class="py-2 px-4">{{ $log->order_id }}</td>
                            <td class="py-2 px-4">{{ $log->user->name }}</td>
                            <td class="py-2 px-4">{{ $log->action }}</td>
                            <td class="py-2 px-4">{{ $log->description }}</td>
                            <td class="py-2 px-4">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
