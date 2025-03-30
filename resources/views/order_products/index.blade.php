<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Products</title>
</head>
<body>
<h1>Order Products</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Order</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order_products as $order_product)
        <tr>
            <td>{{ $order_product->id }}</td>
            <td>
                @if($order_product->customer_order)
                    Customer Order: {{ $order_product->customer_order->invoice_number }}
                @elseif($order_product->enterprise_order)
                    Enterprise Order: {{ $order_product->enterprise_order->order_number }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ $order_product->product ? $order_product->product->name : 'N/A' }}</td>
            <td>{{ $order_product->quantity }}</td>
            <td>{{ $order_product->unit_price }}</td>
            <td>{{ $order_product->total_price }}</td>
            <td>
                <a href="{{ route('order_products.show', $order_product->id) }}">Show</a>
                <a href="{{ route('order_products.edit', $order_product->id) }}">Edit</a>
                <form action="{{ route('order_products.destroy', $order_product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr>
<a href="{{ route('order_products.create') }}">Create New Order Product</a>
</body>
</html>
