<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Role Details</title>
</head>
<body>
    <h1>Role Details</h1>
    <p><strong>ID:</strong> {{ $role->id }}</p>
    <p><strong>Name:</strong> {{ $role->name }}</p>
    <p><strong>Description:</strong> {{ $role->description }}</p>
    
    @if(isset($role->users) && $role->users->count() > 0)
        <h2>Users with this role</h2>
        <ul>
            @foreach($role->users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    @endif
    
    <a href="{{ route('roles.index') }}">Back</a>
</body>
</html>