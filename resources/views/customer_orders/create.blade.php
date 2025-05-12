<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8 px-4 max-w-4xl">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-800">Create Customer Order</h1>

        <form action="{{ route('customer_orders.store') }}" method="POST" class="bg-gray-50 shadow-lg rounded-lg p-8 border border-gray-200">
            @csrf

            <div class="mb-6">
                <label for="invoice_number" class="block text-sm font-semibold text-gray-700 mb-2">Invoice Number</label>
                <input type="text" name="invoice_number" id="invoice_number" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Enter invoice number">
            </div>

            <div class="mb-6">
                <label for="customer_number" class="block text-sm font-semibold text-gray-700 mb-2">Customer</label>
                <select name="customer_number" id="customer_number" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm bg-white">
                    <option value="" disabled selected>Select a customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customerNumber }}">{{ $customer->name }} ({{ $customer->customerNumber }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Enter customer name">
            </div>

            <div class="mb-6">
                <label for="fiscal_data" class="block text-sm font-semibold text-gray-700 mb-2">Fiscal Data</label>
                <input type="text" name="fiscal_data" id="fiscal_data" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Enter fiscal data">
            </div>

            <div class="mb-6">
                <label for="order_date" class="block text-sm font-semibold text-gray-700 mb-2">Order Date</label>
                <input type="date" name="order_date" id="order_date" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </div>

            <div class="mb-6">
                <label for="delivery_address" class="block text-sm font-semibold text-gray-700 mb-2">Delivery Address</label>
                <input type="text" name="delivery_address" id="delivery_address" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Enter delivery address">
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                <textarea name="notes" id="notes" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" rows="4" placeholder="Enter additional notes"></textarea>
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm bg-white">
                    <option value="ORDERED">Ordered</option>
                    <option value="IN_PROCESS">In Process</option>
                    <option value="IN_ROUTE">In Route</option>
                    <option value="DELIVERED">Delivered</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="total_amount" class="block text-sm font-semibold text-gray-700 mb-2">Total Amount</label>
                <input type="text" name="total_amount" id="total_amount" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Enter total amount">
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('customer_orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">Cancel</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create</button>
            </div>
        </form>
    </div>
</body>
</html>