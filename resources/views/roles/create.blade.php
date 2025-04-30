<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Create Role</title>
</head>
<body>
    <h1>Create Role</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea><br>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('roles.index') }}">Back</a>
</body>
</html>
