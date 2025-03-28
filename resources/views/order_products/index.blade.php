<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Products</title>
</head>
<body>
<h1>Order Products</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Order id</th>
        <th>Product id</th>
        <th>Quantity</th>
        <th>Unit price</th>
        <th>Total price</th>
    </tr>
    </thead>

    <tbody>
    @foreach($order_products as $order_product)
        <tr>
            <td>{{ $order_product->id }}</td>
            <td>{{ $order_product->customer_order->id }}</td>
            <td>{{ $order_product->product->id }}</td>
            <td>{{ $order_product->quantity }}</td>
            <td>{{ $order_product->unit_price }}</td>
            <td>{{ $order_product->total_price }}</td>
            <td>
                <a href="{{route('order_products.show', $order_product->id)}}">Show</a>
                <a href="{{route('order_products.edit', $order_product->id)}}">Edit</a>

                <form action="{{route('order_products.edit', $order_product->id )}}" method="post">
                    @csrf
                    @method('delete')

                    <input type="submit" value="Delete" onclick="return confirm('Are you pretty sure? There is no way back')">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

<hr>
<a href="{{route('order_products.create')}}">Create new order product</a>
<hr>

</body>
</html>
