<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Enterprise Order</title>
</head>
<body>
<h1>Enterprise Order Details</h1>

<p><strong>Order Number:</strong> {{ $enterpriseOrder->order_number }}</p>
<p><strong>Supplier Name:</strong> {{ $enterpriseOrder->supplier_name }}</p>
<p><strong>Supplier Contact:</strong> {{ $enterpriseOrder->supplier_contact }}</p>
<p><strong>Order Date:</strong> {{ $enterpriseOrder->order_date }}</p>
<p><strong>Delivery Address:</strong> {{ $enterpriseOrder->delivery_address }}</p>
<p><strong>Notes:</strong> {{ $enterpriseOrder->notes }}</p>
<p><strong>Status:</strong> {{ $enterpriseOrder->status }}</p>
<p><strong>Total Amount:</strong> {{ $enterpriseOrder->total_amount }}</p>

<a href="{{ route('enterprise_orders.index') }}">Back</a>
</body>
</html>
