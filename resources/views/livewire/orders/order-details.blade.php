<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Order Details</h1>

	<!-- Customer Information -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Customer Information</h2>
		<p><strong>Name:</strong> {{ $order->customer->name }}</p>
		<p><strong>Email:</strong> {{ $order->customer->email }}</p>
		<p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
		<p><strong>Address:</strong> {{ $order->customer->address }}</p>
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
				@foreach ($order->orderItems as $item)
					<tr>
						<td>{{ $item->product->name }}</td>
						<td>{{ $item->quantity }}</td>
						<td>{{ number_format($item->unit_price, 2) }}</td>
						<td>{{ number_format($item->total, 2) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Order Summary -->
	<div class="mb-6 rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-lg font-semibold">Order Summary</h2>
		<p><strong>Order Date:</strong> {{ $order->order_date->format('Y-m-d') }}</p>
		<p><strong>Status:</strong> {{ $order->status }}</p>
		<p><strong>Subtotal:</strong> {{ number_format($order->orderItems->sum('total'), 2) }}</p>
		<p><strong>Tax ({{ $order->tax_rate }}%):</strong>
			{{ number_format(($order->orderItems->sum('total') * $order->tax_rate) / 100, 2) }}</p>
		<p><strong>Total:</strong>
			{{ number_format($order->orderItems->sum('total') + ($order->orderItems->sum('total') * $order->tax_rate) / 100, 2) }}
		</p>
	</div>

	<!-- Order Actions -->
	<div class="mt-6 flex justify-end space-x-4">
		<a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit Order</a>
		<button class="btn btn-secondary" onclick="window.print()">Print Order</button>
		<a href="{{ route('invoices.generate', $order->id) }}" class="btn btn-success">Generate Invoice</a>
	</div>
</div>
