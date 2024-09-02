<!DOCTYPE html>
<html>
<head>
    <title>Packing List #{{ $packingList->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Packing List #{{ $packingList->id }}</h1>
    <p><strong>Order ID:</strong> {{ $packingList->order->order_id }}</p>
    <p><strong>Customer:</strong> {{ $packingList->order->customer->name }}</p>
    <p><strong>Packing Date:</strong> {{ $packingList->packing_date->format('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packingList->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
