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

    <div class="container mx-auto py-8 px-4 max-w-4xl">
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

        <form action="{{ route('order_products.store') }}" method="POST" class="bg-white shadow-xl rounded-lg p-8 border border-gray-200">
            @csrf
            <div class="mb-6">
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

            <div id="products-container">
                <div class="mb-4">
                    <button type="button" id="add-product" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-black shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        Add Product
                    </button>
                </div>

                <div class="products-list space-y-4">
                    <div class="product-row bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Product:</label>
                                <select name="products[0][product_id]" class="product-select mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 bg-white" required>
                                    <option value="" disabled selected>Select a product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }} ({{ $product->product_id }}) - ${{ number_format($product->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity:</label>
                                <input type="number" name="products[0][quantity]" class="quantity-input mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2" required min="1">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Unit Price:</label>
                                <input type="number" name="products[0][unit_price]" class="unit-price-input mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2" step="0.01" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-semibold text-gray-700">Total:</label>
                            <p class="total-display text-lg font-bold text-blue-600">$0.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700">Grand Total:</label>
                <p id="grand-total" class="text-xl font-bold text-green-600">$0.00</p>
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('order_products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors duration-200">Back</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create</button>
            </div>
        </form>
    </div>

    <script>
        let productCount = 0;

        function updateTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit-price-input').value) || 0;
            const total = quantity * unitPrice;
            row.querySelector('.total-display').textContent = '$' + total.toFixed(2);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                const unitPrice = parseFloat(row.querySelector('.unit-price-input').value) || 0;
                grandTotal += quantity * unitPrice;
            });
            document.getElementById('grand-total').textContent = '$' + grandTotal.toFixed(2);
        }

        function setupProductRow(row) {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const unitPriceInput = row.querySelector('.unit-price-input');

            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.dataset.price;
                unitPriceInput.value = price;
                updateTotal(row);
            });

            quantityInput.addEventListener('input', () => updateTotal(row));
            unitPriceInput.addEventListener('input', () => updateTotal(row));
        }

        document.getElementById('add-product').addEventListener('click', function() {
            productCount++;
            const template = document.querySelector('.product-row').cloneNode(true);
            
            // Update names and IDs
            template.querySelectorAll('select, input').forEach(element => {
                element.name = element.name.replace('[0]', `[${productCount}]`);
                if (element.id) element.id = element.id + productCount;
                element.value = ''; // Clear values
            });

            // Add delete button for additional rows
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'mt-2 text-red-600 hover:text-red-800';
            deleteButton.textContent = 'Remove Product';
            deleteButton.onclick = function() {
                template.remove();
                updateGrandTotal();
            };
            template.querySelector('.mt-2').appendChild(deleteButton);

            document.querySelector('.products-list').appendChild(template);
            setupProductRow(template);
        });

        // Setup initial row
        setupProductRow(document.querySelector('.product-row'));
    </script>
</body>
</html>
