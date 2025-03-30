<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enterprise Order</title>
</head>
<body>
<h1>Edit Enterprise Order</h1>

<form action="{{ route('enterprise_orders.update', $enterpriseOrder->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <label for="order_number">Order Number</label>
    <input type="text" name="order_number" id="order_number" value="{{ $enterpriseOrder->order_number }}">
    <br><br>

    <label for="supplier_name">Supplier Name</label>
    <input type="text" name="supplier_name" id="supplier_name" value="{{ $enterpriseOrder->supplier_name }}">
    <br><br>

    <label for="supplier_contact">Supplier Contact</label>
    <input type="text" name="supplier_contact" id="supplier_contact" value="{{ $enterpriseOrder->supplier_contact }}">
    <br><br>

    <label for="order_date">Order Date</label>
    <input type="date" name="order_date" id="order_date" value="{{ $enterpriseOrder->order_date }}">
    <br><br>

    <label for="delivery_address">Delivery Address</label>
    <input type="text" name="delivery_address" id="delivery_address" value="{{ $enterpriseOrder->delivery_address }}">
    <br><br>

    <label for="notes">Notes</label>
    <textarea name="notes" id="notes">{{ $enterpriseOrder->notes }}</textarea>
    <br><br>

    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="ordered" {{ $enterpriseOrder->status == 'ordered' ? 'selected' : '' }}>Ordered</option>
        <option value="in_process" {{ $enterpriseOrder->status == 'in_process' ? 'selected' : '' }}>In Process</option>
        <option value="in_route" {{ $enterpriseOrder->status == 'in_route' ? 'selected' : '' }}>In Route</option>
        <option value="delivered" {{ $enterpriseOrder->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
    </select>
    <br><br>

    <label for="total_amount">Total Amount</label>
    <input type="text" name="total_amount" id="total_amount" value="{{ $enterpriseOrder->total_amount }}">
    <br><br>

    <input type="submit" value="Update">
</form>
<a href="{{ route('enterprise_orders.index') }}">Back</a>
</body>
</html>
