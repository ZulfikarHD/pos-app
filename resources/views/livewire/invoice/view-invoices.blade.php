<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">View Invoices</h1>

    <!-- Filters -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Filters</h2>
        <div class="flex flex-wrap space-x-4">
            <!-- Search -->
            <div class="mb-4">
                <label class="block text-gray-700">Search</label>
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search by Invoice ID or Customer" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Status Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select wire:model="filterStatus" class="border border-gray-300 p-2 rounded">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Paid">Paid</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>

            <!-- Date From Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Invoice Date From</label>
                <input type="date" wire:model="filterDateFrom" class="border border-gray-300 p-2 rounded">
            </div>

            <!-- Date To Filter -->
            <div class="mb-4">
                <label class="block text-gray-700">Invoice Date To</label>
                <input type="date" wire:model="filterDateTo" class="border border-gray-300 p-2 rounded">
            </div>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white p-4 rounded shadow">
        <table class="w-full bg-white rounded shadow overflow-x-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4">Invoice ID</th>
                    <th class="py-2 px-4">Order ID</th>
                    <th class="py-2 px-4">Customer</th>
                    <th class="py-2 px-4">Total Amount</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Invoice Date</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td class="py-2 px-4">{{ $invoice->invoice_id }}</td>
                        <td class="py-2 px-4">{{ $invoice->order->order_id }}</td>
                        <td class="py-2 px-4">{{ $invoice->order->customer->name }}</td>
                        <td class="py-2 px-4">{{ number_format($invoice->total_amount, 2) }}</td>
                        <td class="py-2 px-4">{{ ucfirst($invoice->status) }}</td>
                        <td class="py-2 px-4">{{ $invoice->invoice_date->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="text-blue-500 hover:underline">View</a>
                            |
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            |
                            <a href="{{ route('invoices.export', $invoice->id)
