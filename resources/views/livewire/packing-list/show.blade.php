@extends('components.layouts.app')

<x-app-layout>
	<div class="container mx-auto p-6">
		<h1 class="mb-6 text-2xl font-semibold">Packing List #{{ $packingList->id }}</h1>

		<div class="mb-6 rounded bg-white p-4 shadow">
			<h2 class="mb-4 text-xl font-semibold">Order Details</h2>
			<p><strong>Order ID:</strong> {{ $packingList->order->order_id }}</p>
			<p><strong>Customer:</strong> {{ $packingList->order->customer->name }}</p>
			<p><strong>Packing Date:</strong> {{ $packingList->packing_date->format('Y-m-d') }}</p>
		</div>

		<div class="rounded bg-white p-4 shadow">
			<h2 class="mb-4 text-xl font-semibold">Items</h2>
			<table class="w-full overflow-x-auto rounded bg-white shadow">
				<thead>
					<tr>
						<th class="px-4 py-2">Product</th>
						<th class="px-4 py-2">Quantity</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($packingList->items as $item)
						<tr>
							<td class="px-4 py-2">{{ $item->product->name }}</td>
							<td class="px-4 py-2">{{ $item->quantity }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<!-- Export Options -->
		<!-- Export Options -->
		<div class="mt-6">
			<a href="{{ route('packing-lists.export', $packingList->id) }}?format=pdf"
				class="mr-2 rounded bg-green-500 px-4 py-2 text-white">Export as PDF</a>
			<a href="{{ route('packing-lists.export', $packingList->id) }}?format=csv"
				class="mr-2 rounded bg-green-500 px-4 py-2 text-white">Export as CSV</a>
			<a href="{{ route('packing-lists.export', $packingList->id) }}?format=print"
				class="rounded bg-blue-500 px-4 py-2 text-white">Print</a>
		</div>

	</div>
</x-app-layout>
