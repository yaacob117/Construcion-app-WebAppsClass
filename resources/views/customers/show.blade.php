<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Customer details</title>
</head>
<body>
    <h1>Customer details</h1>

    <p><strong>Id:</strong> {{ $customer->customerNumber }}</p>
    <p><strong>Name:</strong> {{ $customer->name }}</p>
    <p><strong>Company Name:</strong> {{ $customer->companyName }}</p>
    <p><strong>Fiscal Data:</strong> {{ $customer->fiscalData }}</p>
    <p><strong>Address:</strong> {{ $customer->address }}</p>

    @if(method_exists($customer, 'customerOrders') && $customer->customerOrders && $customer->customerOrders->count() > 0)
        <h2>Orders</h2>
        <ul>
            @foreach($customer->customerOrders as $order)
                <li>Order #{{ $order->id }} - Invoice: {{ $order->invoice_number }} - Date: {{ $order->created_at->format('Y-m-d') }}</li>
            @endforeach
        </ul>
    @else
        <p>This customer has no orders.</p>
    @endif

    <a href="{{ route('customers.index') }}">Back</a>
</body>
</html>