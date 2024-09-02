<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Manage Drafts</h1>

	<!-- Search and Filters -->
	<div class="mb-6 flex items-center justify-between">
		<input type="text" wire:model.debounce.300ms="search" placeholder="Search Drafts..." class="rounded border px-4 py-2">

		<div class="flex space-x-4">
			<select wire:model="filterCustomer" class="rounded border px-4 py-2">
				<option value="">All Customers</option>
				@foreach ($customers as $customer)
					<option value="{{ $customer->id }}">{{ $customer->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<!-- Draft Orders Table -->
	<div class="overflow-x-auto rounded bg-white shadow">
		<table class="w-full">
			<thead>
				<tr>
					<th wire:click="sortBy('order_id')" class="cursor-pointer">Order ID @include('components.sort-icon', ['field' => 'order_id'])</th>
					<th wire:click="sortBy('customer_id')" class="cursor-pointer">Customer @include('components.sort-icon', ['field' => 'customer_id'])</th>
					<th wire:click="sortBy('order_date')" class="cursor-pointer">Order Date @include('components.sort-icon', ['field' => 'order_date'])</th>
					<th>Total</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse($drafts as $draft)
					<tr>
						<td>{{ $draft->order_id }}</td>
						<td>{{ $draft->customer->name }}</td>
						<td>{{ $draft->order_date->format('Y-m-d') }}</td>
						<td>{{ number_format($draft->orderItems->sum('total'), 2) }}</td>
						<td>
							<button class="text-blue-500" wire:click="resumeDraft({{ $draft->id }})">Resume</button>
							<button class="text-green-500" wire:click="submitDraft({{ $draft->id }})">Submit</button>
							<button class="text-red-500" wire:click="deleteDraft({{ $draft->id }})">Delete</button>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" class="p-4 text-center">No drafts found.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<!-- Pagination -->
	<div class="mt-4">
		{{ $drafts->links() }}
	</div>
</div>
