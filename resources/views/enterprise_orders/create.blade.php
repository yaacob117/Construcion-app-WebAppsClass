<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Enterprise Order</title>
</head>
<body>
<h1>Create Enterprise Order</h1>

<form action="{{ route('enterprise_orders.store') }}" method="POST">
    @csrf
    <label for="order_number">Order Number</label>
    <input type="text" name="order_number" id="order_number">
    <br><br>

    <label for="supplier_name">Supplier Name</label>
    <input type="text" name="supplier_name" id="supplier_name">
    <br><br>

    <label for="supplier_contact">Supplier Contact</label>
    <input type="text" name="supplier_contact" id="supplier_contact">
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
        <option value="ordered">Ordered</option>
        <option value="in_process">In Process</option>
        <option value="in_route">In Route</option>
        <option value="delivered">Delivered</option>
    </select>
    <br><br>

    <label for="total_amount">Total Amount</label>
    <input type="text" name="total_amount" id="total_amount">
    <br><br>

    <input type="submit" value="Create">
</form>
<a href="{{ route('enterprise_orders.index') }}">Back</a>
</body>
</html>
