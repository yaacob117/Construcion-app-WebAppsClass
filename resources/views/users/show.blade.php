<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role->name }}</p>
    <a href="{{ route('users.index') }}">Back</a>
</body>
</html>
