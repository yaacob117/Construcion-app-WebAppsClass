<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Enterprise Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Enterprise Order Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong class="font-semibold">Order Number:</strong> {{ $enterpriseOrder->order_number }}</p>
            <p class="mb-4"><strong class="font-semibold">Supplier Name:</strong> {{ $enterpriseOrder->supplier_name }}</p>
            <p class="mb-4"><strong class="font-semibold">Supplier Contact:</strong> {{ $enterpriseOrder->supplier_contact }}</p>
            <p class="mb-4"><strong class="font-semibold">Order Date:</strong> {{ $enterpriseOrder->order_date }}</p>
            <p class="mb-4"><strong class="font-semibold">Delivery Address:</strong> {{ $enterpriseOrder->delivery_address }}</p>
            <p class="mb-4"><strong class="font-semibold">Notes:</strong> {{ $enterpriseOrder->notes }}</p>
            <p class="mb-4"><strong class="font-semibold">Status:</strong> {{ $enterpriseOrder->status }}</p>
            <p class="mb-4"><strong class="font-semibold">Total Amount:</strong> ${{ number_format($enterpriseOrder->total_amount, 2) }}</p>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('enterprise_orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">Back</a>
        </div>
    </div>
</body>
</html>
