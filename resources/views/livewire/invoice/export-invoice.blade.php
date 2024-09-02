<div class="container mx-auto p-6">
	<h1 class="mb-6 text-2xl font-semibold">Export Invoice #{{ $invoice->invoice_id }}</h1>

	<div class="flex space-x-4">
		<button wire:click="exportPDF" class="rounded bg-blue-500 px-4 py-2 text-white">Export as PDF</button>
		<button wire:click="exportCSV" class="rounded bg-green-500 px-4 py-2 text-white">Export as CSV</button>
	</div>
</div>
