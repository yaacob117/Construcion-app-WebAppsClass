<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Customer Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Customer Order Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong class="font-semibold">Invoice Number:</strong> {{ $order->invoice_number }}</p>
            <p class="mb-4"><strong class="font-semibold">Customer Name:</strong> {{ $order->customer_name }}</p>
            <p class="mb-4"><strong class="font-semibold">Fiscal Data:</strong> {{ $order->fiscal_data }}</p>
            <p class="mb-4"><strong class="font-semibold">Order Date:</strong> {{ $order->order_date }}</p>
            <p class="mb-4"><strong class="font-semibold">Delivery Address:</strong> {{ $order->delivery_address }}</p>
            <p class="mb-4"><strong class="font-semibold">Notes:</strong> {{ $order->notes }}</p>
            <p class="mb-4"><strong class="font-semibold">Status:</strong> {{ $order->status }}</p>
            <p class="mb-4"><strong class="font-semibold">Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('customer_orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">Back</a>
        </div>
    </div>
</body>
</html>
