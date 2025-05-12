<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enterprise Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Enterprise Order</h1>

        <form action="{{ route('enterprise_orders.update', $enterpriseOrder->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="order_number" class="block text-sm font-medium text-gray-700">Order Number</label>
                <input type="text" name="order_number" id="order_number" value="{{ $enterpriseOrder->order_number }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="supplier_name" class="block text-sm font-medium text-gray-700">Supplier Name</label>
                <input type="text" name="supplier_name" id="supplier_name" value="{{ $enterpriseOrder->supplier_name }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="supplier_contact" class="block text-sm font-medium text-gray-700">Supplier Contact</label>
                <input type="text" name="supplier_contact" id="supplier_contact" value="{{ $enterpriseOrder->supplier_contact }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                <input type="date" name="order_date" id="order_date" value="{{ $enterpriseOrder->order_date }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="delivery_address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                <input type="text" name="delivery_address" id="delivery_address" value="{{ $enterpriseOrder->delivery_address }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" id="notes" class="mt-1 block w-full border-gray-300 rounded-md">{{ $enterpriseOrder->notes }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="ordered" {{ $enterpriseOrder->status == 'ordered' ? 'selected' : '' }}>Ordered</option>
                    <option value="in_process" {{ $enterpriseOrder->status == 'in_process' ? 'selected' : '' }}>In Process</option>
                    <option value="in_route" {{ $enterpriseOrder->status == 'in_route' ? 'selected' : '' }}>In Route</option>
                    <option value="delivered" {{ $enterpriseOrder->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="text" name="total_amount" id="total_amount" value="{{ $enterpriseOrder->total_amount }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('enterprise_orders.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
