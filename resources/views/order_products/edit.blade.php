<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8 px-4 max-w-2xl">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">Edit Order Product</h1>

        <form action="{{ route('order_products.update', $order_product->id) }}" method="POST" class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label for="order_id" class="block text-sm font-semibold text-gray-700 mb-1">Order ID:</label>
                <input type="text" name="order_id" id="order_id" value="{{ $order_product->order_id }}" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-1">Product:</label>
                <select name="product_id" id="product_id" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 bg-white">
                    <option value="" disabled>Select a product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $order_product->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} ({{ $product->product_id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="{{ $order_product->quantity }}" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="unit_price" class="block text-sm font-semibold text-gray-700 mb-1">Unit Price:</label>
                <input type="number" name="unit_price" id="unit_price" value="{{ $order_product->unit_price }}" step="0.01" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="total_price" class="block text-sm font-semibold text-gray-700 mb-1">Total Price:</label>
                <input type="number" name="total_price" id="total_price" value="{{ $order_product->total_price }}" step="0.01" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('order_products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors duration-200">Back</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Update</button>
            </div>
        </form>
    </div>
</body>
</html>