<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Revenue Reports</h1>

	<form wire:submit.prevent="generateReport" class="mb-6">
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

		<button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Generate Report</button>
	</form>

	<div class="rounded bg-white p-4 shadow">
		<h2 class="mb-4 text-xl font-semibold">Report Results</h2>

		@if (count($reports) > 0)
			<table class="w-full overflow-x-auto rounded bg-white shadow">
				<thead>
					<tr>
						<th class="px-4 py-2">Date</th>
						<th class="px-4 py-2">Amount</th>
						<th class="px-4 py-2">Source</th>
						<th class="px-4 py-2">Description</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($reports as $report)
						<tr>
							<td class="px-4 py-2">{{ $report->revenue_date->format('Y-m-d') }}</td>
							<td class="px-4 py-2">{{ number_format($report->amount, 2) }}</td>
							<td class="px-4 py-2">{{ $report->source }}</td>
							<td class="px-4 py-2">{{ $report->description }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>No results found for the selected criteria.</p>
		@endif
	</div>
</div>
