<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-12 px-4 max-w-2xl">
        <h1 class="text-4xl font-bold mb-10 text-center text-gray-800">User Details</h1>
        <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 space-y-4">
            <div>
                <strong class="font-semibold text-gray-700">ID:</strong>
                <p class="text-gray-800 mt-1">{{ $user->id }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Username:</strong>
                <p class="text-gray-800 mt-1">{{ $user->username }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Name:</strong>
                <p class="text-gray-800 mt-1">{{ $user->name }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Email:</strong>
                <p class="text-gray-800 mt-1">{{ $user->email }}</p>
            </div>
            <div>
                <strong class="font-semibold text-gray-700">Role:</strong>
                <p class="text-gray-800 mt-1">{{ $user->role->name }}</p>
            </div>
            <div class="mt-8 flex justify-center">
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Back to Users</a>
            </div>
        </div>
    </div>
</body>
</html>
