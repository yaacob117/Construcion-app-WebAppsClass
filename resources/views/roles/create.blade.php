<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Role</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8 px-4 max-w-2xl">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Create Role</h1>
        <form action="{{ route('roles.store') }}" method="POST" class="bg-white shadow-xl rounded-lg p-8 border border-gray-200 space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name:</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 text-gray-800">
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description:</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm p-2 text-gray-800" rows="4"></textarea>
            </div>
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors duration-200">Back</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
