<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer Order</title>
</head>
<body>
<h1>Create Customer Order</h1>

<form action="{{ route('customer_orders.store') }}" method="POST">
    @csrf
    <label for="invoice_number">Invoice Number</label>
    <input type="text" name="invoice_number" id="invoice_number">
    <br><br>

    <label for="customer_number">Customer</label>
    <select name="customer_number" id="customer_number">
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label for="customer_name">Customer Name</label>
    <input type="text" name="customer_name" id="customer_name">
    <br><br>

    <label for="fiscal_data">Fiscal Data</label>
    <input type="text" name="fiscal_data" id="fiscal_data">
    <br><br>

    <label for="order_date">Order Date</label>
    <input type="date" name="order_date" id="order_date">
    <br><br>

    <label for="delivery_address">Delivery Address</label>
    <input type="text" name="delivery_address" id="delivery_address">
    <br><br>

    <label for="notes">Notes</label>
    <textarea name="notes" id="notes"></textarea>
    <br><br>

    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="ORDERED">Ordered</option>
        <option value="IN_PROCESS">In Process</option>
        <option value="IN_ROUTE">In Route</option>
        <option value="DELIVERED">Delivered</option>
    </select>
    <br><br>

    <label for="total_amount">Total Amount</label>
    <input type="text" name="total_amount" id="total_amount">
    <br><br>

    <input type="submit" value="Create">
</form>
<a href="{{ route('customer_orders.index') }}">Back</a>
</body>
</html>
