<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidence Picture Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Evidence Picture Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong class="font-semibold">ID:</strong> {{ $evidencePicture->id }}</p>
            <p class="mb-4"><strong class="font-semibold">Order ID:</strong> {{ $evidencePicture->order_id }}</p>
            <p class="mb-4"><strong class="font-semibold">Sent Photo URL:</strong> <a href="{{ $evidencePicture->sent_photo_url }}" class="text-blue-600 hover:underline">View Photo</a></p>
            <p class="mb-4"><strong class="font-semibold">Received Photo URL:</strong> <a href="{{ $evidencePicture->received_photo_url }}" class="text-blue-600 hover:underline">View Photo</a></p>
            <p class="mb-4"><strong class="font-semibold">Sent At:</strong> {{ $evidencePicture->sent_at }}</p>
            <p class="mb-4"><strong class="font-semibold">Received At:</strong> {{ $evidencePicture->received_at }}</p>
            <p class="mb-4"><strong class="font-semibold">Uploaded By:</strong> {{ $evidencePicture->uploaded_by }}</p>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('evidence_pictures.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-md transition duration-200">Back</a>
        </div>
    </div>
</body>
</html>