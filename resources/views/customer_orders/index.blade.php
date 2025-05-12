<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Customer Orders</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left">Id</th>
                    <th class="py-3 px-4 text-left">Invoice Number</th>
                    <th class="py-3 px-4 text-left">Customer Name</th>
                    <th class="py-3 px-4 text-left">Order Date</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Total Amount</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $order->id }}</td>
                        <td class="py-3 px-4">{{ $order->invoice_number }}</td>
                        <td class="py-3 px-4">{{ $order->customer_name }}</td>
                        <td class="py-3 px-4">{{ $order->order_date }}</td>
                        <td class="py-3 px-4">{{ $order->status }}</td>
                        <td class="py-3 px-4">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('customer_orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                            <a href="{{ route('customer_orders.edit', $order->id) }}" class="text-green-600 hover:text-green-900">Edit</a>
                            <form action="{{ route('customer_orders.destroy', $order->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('customer_orders.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create New Order</a>
        </div>
    </div>
</body>
</html>
