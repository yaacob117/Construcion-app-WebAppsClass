<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" required><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required><br>
        <label for="supplier">Supplier:</label>
        <input type="text" name="supplier" id="supplier" required><br>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('products.index') }}">Back</a>
</body>
</html>