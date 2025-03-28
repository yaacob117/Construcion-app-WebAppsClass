<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" value="{{ $product->product_id }}" required><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $product->description }}</textarea><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}" required><br>
        <label for="supplier">Supplier:</label>
        <input type="text" name="supplier" id="supplier" value="{{ $product->supplier }}" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('products.index') }}">Back</a>
</body>
</html>