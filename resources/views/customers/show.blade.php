<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Customer Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong class="font-semibold">Id:</strong> {{ $customer->customerNumber }}</p>
            <p class="mb-4"><strong class="font-semibold">Name:</strong> {{ $customer->name }}</p>
            <p class="mb-4"><strong class="font-semibold">Company Name:</strong> {{ $customer->companyName }}</p>
            <p class="mb-4"><strong class="font-semibold">Fiscal Data:</strong> {{ $customer->fiscalData }}</p>
            <p class="mb-4"><strong class="font-semibold">Address:</strong> {{ $customer->address }}</p>
        </div>

        @if(method_exists($customer, 'customerOrders') && $customer->customerOrders && $customer->customerOrders->count() > 0)
            <h2 class="text-2xl font-semibold mt-8 mb-4">Orders</h2>
            <ul class="list-disc pl-6">
                @foreach($customer->customerOrders as $order)
                    <li>Order #{{ $order->id }} - Invoice: {{ $order->invoice_number }} - Date: {{ $order->created_at->format('Y-m-d') }}</li>
                @endforeach
            </ul>
        @else
            <p class="mt-4 text-gray-600">This customer has no orders.</p>
        @endif

        <div class="mt-6 flex justify-center">
            <a href="{{ route('customers.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">Back</a>
        </div>
    </div>
</body>
</html>