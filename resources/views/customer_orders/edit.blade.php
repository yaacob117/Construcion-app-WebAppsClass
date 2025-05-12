<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Customer Order</h1>

        <form action="{{ route('customer_orders.update', $order->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                <input type="text" name="invoice_number" id="invoice_number" value="{{ $order->invoice_number }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="customer_number" class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="customer_number" id="customer_number" class="mt-1 block w-full border-gray-300 rounded-md">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customerNumber }}" {{ $order->customer_number == $customer->customerNumber ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->customerNumber }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ $order->customer_name }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="fiscal_data" class="block text-sm font-medium text-gray-700">Fiscal Data</label>
                <input type="text" name="fiscal_data" id="fiscal_data" value="{{ $order->fiscal_data }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="delivery_address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                <input type="text" name="delivery_address" id="delivery_address" value="{{ $order->delivery_address }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" id="notes" class="mt-1 block w-full border-gray-300 rounded-md">{{ $order->notes }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="ORDERED" {{ $order->status == 'ORDERED' ? 'selected' : '' }}>Ordered</option>
                    <option value="IN_PROCESS" {{ $order->status == 'IN_PROCESS' ? 'selected' : '' }}>In Process</option>
                    <option value="IN_ROUTE" {{ $order->status == 'IN_ROUTE' ? 'selected' : '' }}>In Route</option>
                    <option value="DELIVERED" {{ $order->status == 'DELIVERED' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="text" name="total_amount" id="total_amount" value="{{ $order->total_amount }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('customer_orders.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
