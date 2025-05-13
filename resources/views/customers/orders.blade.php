<!DOCTYPE html>
<html>
<head>
    <title>Order List</title>
</head>
<body>
    <h1>Order</h1>

    @if (count($orders) > 0)
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client/Enterprise</th>
                    <th>Order date</th>
                    <th>Total</th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order['id'] }}</td>
                        <td>{{ $order['customer_name'] ?? $order['enterprise_name'] ?? 'N/A' }}</td>
                        <td>{{ $order['order_date'] }}</td>
                        <td>{{ $order['total'] }}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No available orders.</p>
    @endif

    <a href="{{ route('home') }}">Back</a>
</body>
</html>