<!DOCTYPE html>
<html>

<head>
	<title>Revenue Report</title>
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
	<h1>Revenue Report</h1>
	<p>Date: {{ now()->format('Y-m-d') }}</p>

	<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Amount</th>
				<th>Source</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($revenues as $revenue)
				<tr>
					<td>{{ $revenue->revenue_date->format('Y-m-d') }}</td>
					<td>{{ number_format($revenue->amount, 2) }}</td>
					<td>{{ $revenue->source }}</td>
					<td>{{ $revenue->description }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>

</html>
