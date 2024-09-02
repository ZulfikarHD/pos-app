<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Create New Order</h1>

	<!-- Customer Selection -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Select Customer</h2>
		<select class="w-full rounded border px-4 py-2" wire:model="selectedCustomer">
			<option value="">Select a customer...</option>
			@foreach ($customers as $customer)
				<option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
			@endforeach
		</select>
		<button class="btn btn-link mt-2" wire:click="showCustomerForm">+ Add New Customer</button>

		@if ($showCustomerForm)
			<!-- Include form fields for adding a new customer -->
			<div class="mt-4">
				<input type="text" wire:model="newCustomer.name" placeholder="Customer Name"
					class="mb-2 w-full rounded border px-4 py-2">
				<input type="email" wire:model="newCustomer.email" placeholder="Customer Email"
					class="mb-2 w-full rounded border px-4 py-2">
				<input type="text" wire:model="newCustomer.phone" placeholder="Customer Phone"
					class="mb-2 w-full rounded border px-4 py-2">
				<input type="text" wire:model="newCustomer.address" placeholder="Customer Address"
					class="mb-2 w-full rounded border px-4 py-2">
				<button class="btn btn-primary" wire:click="addCustomer">Add Customer</button>
			</div>
		@endif
	</div>

	<!-- Order Items -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Order Items</h2>
		<table class="w-full">
			<thead>
				<tr>
					<th class="text-left">Product</th>
					<th class="text-left">Quantity</th>
					<th class="text-left">Unit Price</th>
					<th class="text-left">Total</th>
					<th></th>
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
							<input type="text" wire:model="orderItems.{{ $index }}.total"
								class="w-full rounded border px-4 py-2" readonly>
						</td>
						<td>
							<button class="btn btn-danger" wire:click="removeItem({{ $index }})">Remove</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<button class="btn btn-link mt-4" wire:click="addItem">+ Add Another Product</button>
	</div>

	<!-- Order Summary -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Order Summary</h2>
		<div class="mb-2 flex justify-between">
			<span>Subtotal:</span>
			<span>{{ number_format($subtotal, 2) }}</span>
		</div>
		<div class="mb-2 flex justify-between">
			<span>Tax ({{ $taxRate }}%):</span>
			<span>{{ number_format($taxAmount, 2) }}</span>
		</div>
		<div class="flex justify-between font-semibold">
			<span>Total:</span>
			<span>{{ number_format($total, 2) }}</span>
		</div>
	</div>

	<!-- Actions -->
	<div class="mt-6 flex justify-end space-x-4">
		<button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
		<button class="btn btn-primary" wire:click="saveDraft">Save as Draft</button>
		<button class="btn btn-success" wire:click="submitOrder">Submit Order</button>
	</div>
</div>
