<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles List</title>
</head>
<body>
    <h1>Roles List</h1>

    @if (count($roles) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>description</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}">Show</a>
                            <a href="{{ route('roles.edit', $role->id) }}">Edit</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminate</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No roles registrated.</p>
    @endif

    <a href="{{ route('roles.create') }}">Create new role</a>
</body>
</html>