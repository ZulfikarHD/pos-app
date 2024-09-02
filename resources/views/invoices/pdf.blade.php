<!DOCTYPE html>
<html>

<head>
	<title>Invoice #{{ $invoice->invoice_id }}</title>
	<style>
		body {
			font-family: DejaVu Sans, sans-serif;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		th,
		td {
			border: 1px solid #000;
			padding: 8px;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
		}
	</style>
</head>

<body>
	<h1>Invoice #{{ $invoice->invoice_id }}</h1>
	<p><strong>Order ID:</strong> {{ $invoice->order->order_id }}</p>
	<p><strong>Customer:</strong> {{ $invoice->order->customer->name }}</p>
	<p><strong>Total Amount:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
	<p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
	<p><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('Y-m-d') }}</p>

	<h2>Payment History</h2>
	<table>
		<thead>
			<tr>
				<th>Payment ID</th>
				<th>Amount Paid</th>
				<th>Payment Date</th>
				<th>Payment Method</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($invoice->payments as $payment)
				<tr>
					<td>{{ $payment->payment_id }}</td>
					<td>{{ number_format($payment->amount_paid, 2) }}</td>
					<td>{{ $payment->payment_date->format('Y-m-d') }}</td>
					<td>{{ ucfirst($payment->payment_method) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>

</html>
