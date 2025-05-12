<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-12 px-4 max-w-2xl">
        <h1 class="text-4xl font-bold mb-10 text-center text-gray-800">Role Details</h1>
        <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 space-y-4">
            <div>
                <strong class="font-semibold text-gray-700">ID:</strong>
                <p class="text-gray-800 mt-1">{{ $role->id }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Name:</strong>
                <p class="text-gray-800 mt-1">{{ $role->name }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Description:</strong>
                <p class="text-gray-800 mt-1">{{ $role->description }}</p>
            </div>

            @if(isset($role->users) && $role->users->count() > 0)
                <div class="pt-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Users with this role</h2>
                    <ul class="list-disc list-inside space-y-1 text-gray-800">
                        @foreach($role->users as $user)
                            <li>{{ $user->name }} ({{ $user->email }})</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-8 flex justify-center">
                <a href="{{ route('roles.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Back to Roles</a>
            </div>
        </div>
    </div>
</body>
</html>