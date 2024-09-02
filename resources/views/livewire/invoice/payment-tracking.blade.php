<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Payment Tracking for Invoice #{{ $invoice->invoice_id }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Payment History</h2>
        <table class="w-full bg-white rounded shadow overflow-x-auto">
            <thead>
                <tr>
                    <th class="py-2 px-4">Payment ID</th>
                    <th class="py-2 px-4">Amount Paid</th>
                    <th class="py-2 px-4">Payment Date</th>
                    <th class="py-2 px-4">Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td class="py-2 px-4">{{ $payment->payment_id }}</td>
                        <td class="py-2 px-4">{{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="py-2 px-4">{{ $payment->payment_date->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">{{ ucfirst($payment->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($payments->isEmpty())
            <p class="text-gray-600">No payments recorded for this invoice.</p>
        @endif
    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Add Payment</h2>

        <form wire:submit.prevent="addPayment">
            <div class="mb-4">
                <label class="block text-gray-700">Payment Amount</label>
                <input type="number" wire:model="paymentAmount" step="0.01" class="border border-gray-300 p-2 rounded w-full">
                @error('paymentAmount') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Payment Date</label>
                <input type="date" wire:model="paymentDate" class="border border-gray-300 p-2 rounded w-full">
                @error('paymentDate') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Payment Method</label>
                <select wire:model="paymentMethod" class="border border-gray-300 p-2 rounded w-full">
                    <option value="">Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash">Cash</option>
                </select>
                @error('paymentMethod') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Payment</button>
        </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Invoice Status</h2>
        <p><strong>Status:</strong> {{ ucfirst($invoiceStatus) }}</p>
    </div>
</div>
