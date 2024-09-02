<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">View Orders</h1>

	<!-- Search and Filters -->
	<div class="mb-6 flex items-center justify-between">
		<input type="text" wire:model.debounce.300ms="search" placeholder="Search Orders..." class="rounded border px-4 py-2">

		<div class="flex space-x-4">
			<select wire:model="filterStatus" class="rounded border px-4 py-2">
				<option value="">All Statuses</option>
				<option value="Draft">Draft</option>
				<option value="Submitted">Submitted</option>
				<option value="Completed">Completed</option>
			</select>
			<select wire:model="filterCustomer" class="rounded border px-4 py-2">
				<option value="">All Customers</option>
				@foreach ($customers as $customer)
					<option value="{{ $customer->id }}">{{ $customer->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<!-- Orders Table -->
	<div class="overflow-x-auto rounded bg-white shadow">
		<table class="w-full">
			<thead>
				<tr>
					<th wire:click="sortBy('order_id')" class="cursor-pointer">Order ID @include('components.sort-icon', ['field' => 'order_id'])</th>
					<th wire:click="sortBy('customer_id')" class="cursor-pointer">Customer @include('components.sort-icon', ['field' => 'customer_id'])</th>
					<th wire:click="sortBy('order_date')" class="cursor-pointer">Order Date @include('components.sort-icon', ['field' => 'order_date'])</th>
					<th>Status</th>
					<th>Total</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse($orders as $order)
					<tr>
						<td>{{ $order->order_id }}</td>
						<td>{{ $order->customer->name }}</td>
						<td>{{ $order->order_date->format('Y-m-d') }}</td>
						<td>{{ $order->status }}</td>
						<td>{{ number_format($order->orderItems->sum('total'), 2) }}</td>
						<td>
							<a href="{{ route('orders.show', $order->id) }}" class="text-blue-500">View</a>
							<a href="{{ route('orders.edit', $order->id) }}" class="text-yellow-500">Edit</a>
							<button class="text-red-500" wire:click="deleteOrder({{ $order->id }})">Delete</button>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="6" class="p-4 text-center">No orders found.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<!-- Pagination -->
	<div class="mt-4">
		{{ $orders->links() }}
	</div>
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteOrder', event.detail.orderId);
                }
            })
        });
    </script>
</div>
