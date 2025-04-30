<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order Product</title>
</head>
<body>
<h1>Create Order Product</h1>

<form action="{{ route('order_products.store') }}" method="POST">
    @csrf
    <label for="order_id">Order</label>
    <select name="order_id" id="order_id">
        <optgroup label="Customer Orders">
            @foreach($customer_orders as $customer_order)
                <option value="customer_{{ $customer_order->id }}">Customer Order: {{ $customer_order->invoice_number }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Enterprise Orders">
            @foreach($enterprise_orders as $enterprise_order)
                <option value="enterprise_{{ $enterprise_order->id }}">Enterprise Order: {{ $enterprise_order->order_number }}</option>
            @endforeach
        </optgroup>
    </select>
    <br><br>

    <label for="product_id">Product</label>
    <select name="product_id" id="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="quantity">
    <br><br>

    <label for="unit_price">Unit Price</label>
    <input type="text" name="unit_price" id="unit_price">
    <br><br>

    <label for="total_price">Total Price</label>
    <input type="text" name="total_price" id="total_price">
    <br><br>

    <input type="submit" value="Create">
</form>
<a href="{{ route('order_products.index') }}">Back</a>
</body>
</html>
