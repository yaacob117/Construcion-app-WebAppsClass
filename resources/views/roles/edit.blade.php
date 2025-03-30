<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Edit Role</title>
</head>
<body>
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $role->description }}</textarea><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('roles.index') }}">Back</a>
</body>
</html>