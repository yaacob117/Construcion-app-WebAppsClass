<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Order Status</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
            <p class="mb-2"><strong>Customer Number:</strong> {{ $customer->customerNumber }}</p>
            <p class="mb-2"><strong>Name:</strong> {{ $customer->name }}</p>
            <p class="mb-4"><strong>Company:</strong> {{ $customer->companyName }}</p>

            <h2 class="text-xl font-semibold mb-4 mt-6">Order Information</h2>
            <p class="mb-2"><strong>Invoice Number:</strong> {{ $order->invoice_number }}</p>
            <p class="mb-2"><strong>Order Date:</strong> {{ $order->order_date }}</p>
            <p class="mb-2"><strong>Status:</strong> 
                <span class="px-2 py-1 rounded text-white
                    @if($order->status == 'ORDERED') bg-blue-500
                    @elseif($order->status == 'IN_PROCESS') bg-yellow-500
                    @elseif($order->status == 'IN_ROUTE') bg-purple-500
                    @elseif($order->status == 'DELIVERED') bg-green-500
                    @endif">
                    {{ $order->status }}
                </span>
            </p>
            <p class="mb-2"><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
            <p class="mb-2"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            @if($order->notes)
                <p class="mb-2"><strong>Notes:</strong> {{ $order->notes }}</p>
            @endif
        </div>

        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('customers.show', $customer->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Back to Customer</a>
            <a href="{{ route('customer_orders.edit', $order->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Edit Order</a>
        </div>
    </div>
</body>
</html>
