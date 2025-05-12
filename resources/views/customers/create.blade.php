<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Create Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="customerNumber" class="block text-sm font-medium text-gray-700">Id:</label>
                <input type="text" name="customerNumber" id="customerNumber" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="companyName" class="block text-sm font-medium text-gray-700">Company Name:</label>
                <input type="text" name="companyName" id="companyName" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="fiscalData" class="block text-sm font-medium text-gray-700">Fiscal Data:</label>
                <input type="text" name="fiscalData" id="fiscalData" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                <textarea name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Create</button>
             </div>
        </form>
    </div>
</body>
</html>