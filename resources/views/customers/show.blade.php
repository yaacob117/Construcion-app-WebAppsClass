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
            <div class="space-y-4">
                @foreach($customer->customerOrders as $order)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">
                                Order #{{ $order->id }} - Invoice: {{ $order->invoice_number }}
                            </h3>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if($order->status === 'DELIVERED') bg-green-100 text-green-800
                                @elseif($order->status === 'IN_ROUTE') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Date: {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-600">Total: ${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('customers.order-status', ['customer' => $customer->id, 'invoiceNumber' => $order->invoice_number]) }}" 
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>

                        @if($order->hasDeliveryEvidence())
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h4 class="text-md font-medium mb-2">Delivery Evidence</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Sent at: {{ $order->evidencePicture->sent_at->format('M d, Y H:i') }}</p>
                                        <a href="{{ $order->evidencePicture->sent_photo_url }}" 
                                           target="_blank"
                                           class="inline-block mt-1 text-blue-600 hover:text-blue-800">
                                            View Sent Photo
                                        </a>
                                    </div>
                                    @if($order->isDeliveryConfirmed())
                                        <div>
                                            <p class="text-sm text-gray-600">Received at: {{ $order->evidencePicture->received_at->format('M d, Y H:i') }}</p>
                                            <a href="{{ $order->evidencePicture->received_photo_url }}" 
                                               target="_blank"
                                               class="inline-block mt-1 text-blue-600 hover:text-blue-800">
                                                View Received Photo
                                            </a>
                                        </div>
                                    @else
                                        <div>
                                            <p class="text-sm text-yellow-600">Waiting for delivery confirmation...</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-4 text-gray-600">This customer has no orders.</p>
        @endif

        <div class="mt-6 flex justify-center">
            <a href="{{ route('customers.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">Back</a>
        </div>
    </div>
</body>
</html>