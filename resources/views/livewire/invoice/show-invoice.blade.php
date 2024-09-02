<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Invoice Details #{{ $invoice->invoice_id }}</h1>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Invoice Information</h2>
        <p><strong>Invoice ID:</strong> {{ $invoice->invoice_id }}</p>
        <p><strong>Order ID:</strong> {{ $invoice->order->order_id }}</p>
        <p><strong>Customer:</strong> {{ $invoice->order->customer->name }}</p>
        <p><strong>Total Amount:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
        <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('Y-m-d') }}</p>
    </div>

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
                @foreach ($invoice->payments as $payment)
                    <tr>
                        <td class="py-2 px-4">{{ $payment->payment_id }}</td>
                        <td class="py-2 px-4">{{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="py-2 px-4">{{ $payment->payment_date->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">{{ ucfirst($payment->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($invoice->payments->isEmpty())
            <p class="text-gray-600">No payments recorded for this invoice.</p>
        @endif
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('invoices.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded">Back to Invoices</a>
        <a href="{{ route('invoices.export', $invoice->id) }}" class="bg-green-500 text-white py-2 px-4 rounded">Export Invoice</a>
        <a href="{{ route('invoices.edit', $invoice->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Edit Invoice</a>
    </div>
</div>
