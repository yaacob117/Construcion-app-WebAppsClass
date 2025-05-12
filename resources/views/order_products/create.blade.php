<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8 px-4 max-w-2xl">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">Create Order Product</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('order_products.store') }}" method="POST" class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 space-y-6">
            @csrf
            <div>
                <label for="order_id" class="block text-sm font-semibold text-gray-700 mb-1">Order:</label>
                <select name="order_id" id="order_id" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 bg-white">
                    <option value="" disabled selected>Select an order</option>
                    <optgroup label="Customer Orders">
                        @foreach($customer_orders as $customer_order)
                            <option value="customer_{{ $customer_order->id }}">
                                Customer Order: {{ $customer_order->invoice_number }} 
                                (Status: {{ $customer_order->status }})
                            </option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Enterprise Orders">
                        @foreach($enterprise_orders as $enterprise_order)
                            <option value="enterprise_{{ $enterprise_order->id }}">Enterprise Order: {{ $enterprise_order->order_number }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

            <div>
                <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-1">Product:</label>
                <select name="product_id" id="product_id" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 bg-white">
                    <option value="" disabled selected>Select a product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} ({{ $product->product_id }}) - ${{ number_format($product->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">Quantity:</label>
                <input type="number" name="quantity" id="quantity" required min="1" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="unit_price" class="block text-sm font-semibold text-gray-700 mb-1">Unit Price:</label>
                <input type="number" name="unit_price" id="unit_price" step="0.01" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Total Price:</label>
                <p id="total_price_display" class="text-lg font-bold text-blue-600">$0.00</p>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('order_products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors duration-200">Back</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create</button>
            </div>
        </form>
    </div>

    <script>
        // Función para actualizar el precio unitario cuando se selecciona un producto
        document.getElementById('product_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.dataset.price;
            document.getElementById('unit_price').value = price;
            updateTotal();
        });

        // Función para actualizar el total cuando cambia la cantidad o el precio unitario
        document.getElementById('quantity').addEventListener('input', updateTotal);
        document.getElementById('unit_price').addEventListener('input', updateTotal);

        function updateTotal() {
            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
            const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
            const total = quantity * unitPrice;
            document.getElementById('total_price_display').textContent = '$' + total.toFixed(2);
        }
    </script>
</body>
</html>
