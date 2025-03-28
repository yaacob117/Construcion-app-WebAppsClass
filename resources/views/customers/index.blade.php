<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers List</title>
</head>
<body>
    <h1>Customers List</h1>

    @if (count($customers) > 0)
        <table>
            <thead>
                <tr>
                    <th>Id Customer</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Fiscal Data</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->customerNumber }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->companyName }}</td>
                        <td>{{ $customer->fiscalData }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->customerNumber) }}">View</a>
                            <a href="{{ route('customers.edit', $customer->customerNumber) }}">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->customerNumber) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                            <a href="{{ route('customers.order-status', ['customer' => $customer->customerNumber, 'invoiceNumber' => 'INV-001']) }}">Order status</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>There is not customers.</p>
    @endif

    <a href="{{ route('customers.create') }}">Create new customer</a>
</body>
</html>