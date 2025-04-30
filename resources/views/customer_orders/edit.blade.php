<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Order</title>
</head>
<body>
<h1>Edit Customer Order</h1>

<form action="{{ route('customer_orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <label for="invoice_number">Invoice Number</label>
    <input type="text" name="invoice_number" id="invoice_number" value="{{ $order->invoice_number }}">
    <br><br>

    <label for="customer_number">Customer</label>
    <select name="customer_number" id="customer_number">
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ $order->customer_number == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label for="customer_name">Customer Name</label>
    <input type="text" name="customer_name" id="customer_name" value="{{ $order->customer_name }}">
    <br><br>

    <label for="fiscal_data">Fiscal Data</label>
    <input type="text" name="fiscal_data" id="fiscal_data" value="{{ $order->fiscal_data }}">
    <br><br>

    <label for="order_date">Order Date</label>
    <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}">
    <br><br>

    <label for="delivery_address">Delivery Address</label>
    <input type="text" name="delivery_address" id="delivery_address" value="{{ $order->delivery_address }}">
    <br><br>

    <label for="notes">Notes</label>
    <textarea name="notes" id="notes">{{ $order->notes }}</textarea>
    <br><br>

    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="ORDERED" {{ $order->status == 'ORDERED' ? 'selected' : '' }}>Ordered</option>
        <option value="IN_PROCESS" {{ $order->status == 'IN_PROCESS' ? 'selected' : '' }}>In Process</option>
        <option value="IN_ROUTE" {{ $order->status == 'IN_ROUTE' ? 'selected' : '' }}>In Route</option>
        <option value="DELIVERED" {{ $order->status == 'DELIVERED' ? 'selected' : '' }}>Delivered</option>
    </select>
    <br><br>

    <label for="total_amount">Total Amount</label>
    <input type="text" name="total_amount" id="total_amount" value="{{ $order->total_amount }}">
    <br><br>

    <input type="submit" value="Update">
</form>
<a href="{{ route('customer_orders.index') }}">Back</a>
</body>
</html>
