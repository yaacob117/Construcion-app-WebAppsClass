<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->invoice_number }} Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Order #{{ $order->invoice_number }}</h1>
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                @if($order->status === 'DELIVERED') bg-green-100 text-green-800
                @elseif($order->status === 'IN_ROUTE') bg-yellow-100 text-yellow-800
                @else bg-blue-100 text-blue-800
                @endif">
                {{ $order->status }}
            </span>
        </div>

        <!-- Order Details -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Order Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="mb-4"><strong class="font-semibold">Customer:</strong> {{ $order->customer_name }}</p>
                    <p class="mb-4"><strong class="font-semibold">Fiscal Data:</strong> {{ $order->fiscal_data }}</p>
                    <p class="mb-4"><strong class="font-semibold">Order Date:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="mb-4"><strong class="font-semibold">Delivery Address:</strong> {{ $order->delivery_address }}</p>
                    <p class="mb-4"><strong class="font-semibold">Notes:</strong> {{ $order->notes ?: 'No notes' }}</p>
                    <p class="mb-4"><strong class="font-semibold">Total Amount:</strong> 
                        <span class="text-lg font-bold text-green-600">${{ number_format($order->total_amount, 2) }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Order Products</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderProducts as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->unit_price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delivery Evidence -->
        <x-delivery-evidence :order="$order" />

        <div class="mt-6 flex justify-between">
            <a href="{{ route('customer_orders.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">
                Back to Orders
            </a>
            
            @if($order->status !== 'DELIVERED' && auth()->user()->hasRole('Warehouse'))
                <a href="{{ route('evidence_pictures.create', ['order_id' => $order->id]) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">
                    Upload Delivery Evidence
                </a>
            @endif
        </div>
    </div>
</body>
</html>
