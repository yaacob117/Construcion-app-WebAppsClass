<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Product</title>
</head>
<body>
<h1>Order Product:  {{ $order_product->id }}</h1>
<h3>Order ID: {{ $order_product->customer_order->id }}</h3>
<h3>Product ID: {{ $order_product->product->id }}</h3>
<h3>Quantity: {{ $order_product->quantity }}</h3>
<h3>Unit Price: {{ $order_product->unit_price }}</h3>
<h3>Total Price: {{ $order_product->total_price }}</h3>

<br>
<a href="{{route('order_products.index')}}">All Order Products</a>
<br>

</body>
</html>
