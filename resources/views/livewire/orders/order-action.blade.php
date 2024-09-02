<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Edit Order</h1>

	<!-- Customer Selection -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Select Customer</h2>
		<select class="w-full rounded border px-4 py-2" wire:model="order.customer_id">
			@foreach ($customers as $customer)
				<option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
			@endforeach
		</select>
	</div>

	<!-- Order Items -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Order Items</h2>
		<table class="w-full">
			<thead>
				<tr>
					<th>Product</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderItems as $index => $item)
					<tr>
						<td>
							<select class="w-full rounded border px-4 py-2" wire:model="orderItems.{{ $index }}.product_id">
								<option value="">Select a product...</option>
								@foreach ($products as $product)
									<option value="{{ $product->id }}">{{ $product->name }}</option>
								@endforeach
							</select>
						</td>
						<td>
							<input type="number" wire:model="orderItems.{{ $index }}.quantity"
								class="w-full rounded border px-4 py-2">
						</td>
						<td>
							<input type="text" wire:model="orderItems.{{ $index }}.unit_price"
								class="w-full rounded border px-4 py-2" readonly>
						</td>
						<td>
							<input type="text" wire:model="orderItems.{{ $index }}.total" class="w-full rounded border px-4 py-2"
								readonly>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Actions -->
	<div class="mt-6 flex justify-end space-x-4">
		<button class="btn btn-primary" wire:click="updateOrder">Update Order</button>
		<button class="btn btn-danger" onclick="confirmDeleteOrder()">Delete Order</button>
	</div>

    <script>
        function confirmDeleteOrder() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteOrder');
                }
            });
        }
    </script>
</div>

