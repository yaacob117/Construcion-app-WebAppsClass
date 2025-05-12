<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-12 px-4 max-w-3xl">
        <h1 class="text-4xl font-bold mb-10 text-center text-blue-700">Product Details</h1>
        <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <strong class="font-semibold text-gray-700">Product ID:</strong>
                    <p class="text-gray-800 mt-1">{{ $product->product_id }}</p>
                </div>
                <div>
                    <strong class="font-semibold text-gray-700">Name:</strong>
                    <p class="text-gray-800 mt-1">{{ $product->name }}</p>
                </div>
                <div class="md:col-span-2">
                    <strong class="font-semibold text-gray-700">Description:</strong>
                    <p class="text-gray-800 mt-1">{{ $product->description }}</p>
                </div>
                <div>
                    <strong class="font-semibold text-gray-700">Price:</strong>
                    <p class="text-gray-800 mt-1">${{ number_format($product->price, 2) }}</p>
                </div>
                <div>
                    <strong class="font-semibold text-gray-700">Supplier:</strong>
                    <p class="text-gray-800 mt-1">{{ $product->supplier }}</p>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Back to Products</a>
            </div>
        </div>
    </div>
</body>
</html>