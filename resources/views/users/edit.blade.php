<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{{ $user->username }}" required><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required><br>
        <label for="role_id">Role:</label>
        <select name="role_id" id="role_id" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('users.index') }}">Back</a>
</body>
</html>
