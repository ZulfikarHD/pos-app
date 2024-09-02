<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Add Revenue</h1>

	@if (session()->has('message'))
		<div class="mb-4 rounded bg-green-500 p-3 text-white">
			{{ session('message') }}
		</div>
	@endif

	<form wire:submit.prevent="addRevenue">
		<div class="mb-4">
			<label class="block text-gray-700">Revenue Date</label>
			<input type="date" wire:model="revenueDate" class="w-full rounded border border-gray-300 p-2">
			@error('revenueDate')
				<span class="text-red-500">{{ $message }}</span>
			@enderror
		</div>

		<div class="mb-4">
			<label class="block text-gray-700">Amount</label>
			<input type="number" wire:model="amount" step="0.01" class="w-full rounded border border-gray-300 p-2">
			@error('amount')
				<span class="text-red-500">{{ $message }}</span>
			@enderror
		</div>

		<div class="mb-4">
			<label class="block text-gray-700">Source</label>
			<input type="text" wire:model="source" class="w-full rounded border border-gray-300 p-2">
			@error('source')
				<span class="text-red-500">{{ $message }}</span>
			@enderror
		</div>

		<div class="mb-4">
			<label class="block text-gray-700">Description</label>
			<textarea wire:model="description" class="w-full rounded border border-gray-300 p-2" rows="3"></textarea>
			@error('description')
				<span class="text-red-500">{{ $message }}</span>
			@enderror
		</div>

		<button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Add Revenue</button>
	</form>
</div>
