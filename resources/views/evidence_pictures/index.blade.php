<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidence Picture List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Evidence Picture List</h1>

        <div class="mb-4 flex justify-end">
            <a href="{{ route('evidence_pictures.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">Create Evidence Picture</a>
        </div>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Order ID</th>
                    <th class="py-3 px-4 text-left">Sent Photo URL</th>
                    <th class="py-3 px-4 text-left">Received Photo URL</th>
                    <th class="py-3 px-4 text-left">Sent At</th>
                    <th class="py-3 px-4 text-left">Received At</th>
                    <th class="py-3 px-4 text-left">Uploaded By</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evidencePictures as $evidencePicture)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $evidencePicture->id }}</td>
                        <td class="py-3 px-4">{{ $evidencePicture->order_id }}</td>
                        <td class="py-3 px-4"><a href="{{ $evidencePicture->sent_photo_url }}" class="text-blue-600 hover:underline">View</a></td>
                        <td class="py-3 px-4"><a href="{{ $evidencePicture->received_photo_url }}" class="text-blue-600 hover:underline">View</a></td>
                        <td class="py-3 px-4">{{ $evidencePicture->sent_at }}</td>
                        <td class="py-3 px-4">{{ $evidencePicture->received_at }}</td>
                        <td class="py-3 px-4">{{ $evidencePicture->uploaded_by }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('evidence_pictures.show', $evidencePicture->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                            <a href="{{ route('evidence_pictures.edit', $evidencePicture->id) }}" class="text-green-600 hover:text-green-900">Edit</a>
                            <form action="{{ route('evidence_pictures.destroy', $evidencePicture->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>