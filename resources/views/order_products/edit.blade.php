<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit order product</title>
</head>
<body>
<h1>Edit order product</h1>

<form action="{{route('order_products.update', $customer_order->id)}}" method="POST">
    @csrf
    @method('patch')

    <label for="order_id">Order id</label>
    <select name="order_id" id="order_id">
        @foreach($customer_orders as $customer_order)
            <option value="{{ $customer_order->id }}"></option>
        @endforeach
    </select>
    <br><br>

    <label for="product_id">Product id</label>
    <select name="product_id" id="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}"></option>
        @endforeach
    </select>
    <br><br>

    <label for="quantity">Quantity</label>
    <input type="text" name="quantity" value="{{ $customer_order->quantity }}">
    <br><br>

    <label for="unit_price">Unit price</label>
    <input type="text" name="unit_price" value="{{ $customer_order->unit_price }}">
    <br><br>

    <label for="total_price">Total Price</label>
    <input type="text" name="total_price" value="{{ $customer_order->total_price }}">
    <br><br>

    <input type="submit" value="Edit">
</form>
</body>
</html>
