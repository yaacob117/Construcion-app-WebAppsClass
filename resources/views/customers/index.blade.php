<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Customers List</h1>

        @if (count($customers) > 0)
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left">Id Customer</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Company Name</th>
                        <th class="py-3 px-4 text-left">Fiscal Data</th>
                        <th class="py-3 px-4 text-left">Address</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $customer->customerNumber }}</td>
                            <td class="py-3 px-4">{{ $customer->name }}</td>
                            <td class="py-3 px-4">{{ $customer->companyName }}</td>
                            <td class="py-3 px-4">{{ $customer->fiscalData }}</td>
                            <td class="py-3 px-4">{{ $customer->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('customers.show', $customer->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                @if($customer->customerOrders && $customer->customerOrders->count() > 0)
                                    @foreach($customer->customerOrders as $order)
                                        <a href="{{ route('customers.order-status', ['customer' => $customer->id, 'invoiceNumber' => $order->invoice_number]) }}" 
                                           class="text-yellow-600 hover:text-yellow-900">
                                            Order #{{ $order->invoice_number }}
                                        </a>
                                    @endforeach
                                @else
                                    <span class="text-gray-400">No orders</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4 text-gray-600 text-center">There are no customers.</p>
        @endif

        <div class="mt-6 flex justify-center">
            <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create New Customer</a>
        </div>
    </div>
</body>
</html>