<!DOCTYPE html>
<html>

<head>
	<title>{{ $subject }}</title>
</head>

<body>
	<p>Dear {{ $invoice->order->customer->name }},</p>
	<p>{{ $messageBody }}</p>
	<p>Thank you for your business!</p>
</body>

</html>
