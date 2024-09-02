<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Export Revenue Reports</h1>

	<form wire:submit.prevent="exportPDF" class="mb-6">
		<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
			<div class="mb-4">
				<label class="block text-gray-700">Date From</label>
				<input type="date" wire:model="dateFrom" class="w-full rounded border border-gray-300 p-2">
			</div>

			<div class="mb-4">
				<label class="block text-gray-700">Date To</label>
				<input type="date" wire:model="dateTo" class="w-full rounded border border-gray-300 p-2">
			</div>

			<div class="mb-4">
				<label class="block text-gray-700">Source</label>
				<input type="text" wire:model="source" placeholder="Search by source"
					class="w-full rounded border border-gray-300 p-2">
			</div>
		</div>

		<div class="flex space-x-4">
			<button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Export as PDF</button>
			<button wire:click.prevent="exportCSV" class="rounded bg-green-500 px-4 py-2 text-white">Export as CSV</button>
		</div>
	</form>
</div>
