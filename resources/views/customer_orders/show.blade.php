<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Customer Order</title>
</head>
<body>
<h1>Customer Order Details</h1>

<p><strong>Invoice Number:</strong> {{ $order->invoice_number }}</p>
<p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
<p><strong>Fiscal Data:</strong> {{ $order->fiscal_data }}</p>
<p><strong>Order Date:</strong> {{ $order->order_date }}</p>
<p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
<p><strong>Notes:</strong> {{ $order->notes }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>

<a href="{{ route('customer_orders.index') }}">Back</a>
</body>
</html>
