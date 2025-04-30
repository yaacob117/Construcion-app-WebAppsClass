<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product</title>
</head>
<body>
<h1>Order Product: {{ $order_product->id }}</h1>

<h3>Order ID: 
    @if($order_product->customer_order)
        Customer Order: {{ $order_product->customer_order->id }}
    @elseif($order_product->enterprise_order)
        Enterprise Order: {{ $order_product->enterprise_order->id }}
    @else
        N/A
    @endif
</h3>

<h3>Product ID: {{ $order_product->product ? $order_product->product->id : 'N/A' }}</h3>
<h3>Quantity: {{ $order_product->quantity }}</h3>
<h3>Unit Price: {{ $order_product->unit_price }}</h3>
<h3>Total Price: {{ $order_product->total_price }}</h3>

<br>
<a href="{{ route('order_products.index') }}">All Order Products</a>
</body>
</html>
