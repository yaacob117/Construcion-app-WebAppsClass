<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Edit Rol</title>
</head>
<body>
    <h1>Edit Rol</h1>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $role->description }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('roles.index') }}">Back</a>
</body>
</html>