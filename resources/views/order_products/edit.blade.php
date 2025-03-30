<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Product</title>
</head>
<body>
<h1>Edit Order Product</h1>

<form action="{{ route('order_products.update', $order_product->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="order_id">Order</label>
    <select name="order_id" id="order_id">
        @foreach($customer_orders as $customer_order)
            <option value="{{ $customer_order->id }}" {{ $order_product->order_id == $customer_order->id ? 'selected' : '' }}>
                {{ $customer_order->invoice_number }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label for="product_id">Product</label>
    <select name="product_id" id="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ $order_product->product_id == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="quantity" value="{{ $order_product->quantity }}">
    <br><br>

    <label for="unit_price">Unit Price</label>
    <input type="text" name="unit_price" id="unit_price" value="{{ $order_product->unit_price }}">
    <br><br>

    <label for="total_price">Total Price</label>
    <input type="text" name="total_price" id="total_price" value="{{ $order_product->total_price }}">
    <br><br>

    <input type="submit" value="Update">
</form>
<a href="{{ route('order_products.index') }}">Back</a>
</body>
</html>