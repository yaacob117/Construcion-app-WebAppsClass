<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Orders</title>
</head>
<body>
<h1>Enterprise Orders</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Order Number</th>
        <th>Supplier Name</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Total Amount</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->supplier_name }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>
                <a href="{{ route('enterprise_orders.show', $order->id) }}">Show</a>
                <a href="{{ route('enterprise_orders.edit', $order->id) }}">Edit</a>
                <form action="{{ route('enterprise_orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
<a href="{{ route('enterprise_orders.create') }}">Create New Enterprise Order</a>
</body>
</html>
