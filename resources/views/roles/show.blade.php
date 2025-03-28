<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rol details</title>
</head>
<body>
    <h1>Rol details</h1>

    <p><strong>ID:</strong> {{ $role->id }}</p>
    <p><strong>Name:</strong> {{ $role->name }}</p>
    <p><strong>Description:</strong> {{ $role->description }}</p>

    <a href="{{ route('roles.index') }}">Back</a>
</body>
</html>