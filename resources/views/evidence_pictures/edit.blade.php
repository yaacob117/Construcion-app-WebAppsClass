<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Evidence Picture</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Evidence Picture</h1>

        <form action="{{ route('evidence_pictures.update', $evidencePicture->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="order_id" class="block text-sm font-medium text-gray-700">Order ID</label>
                <select name="order_id" id="order_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    @foreach($customerOrders as $order)
                        <option value="{{ $order->id }}" {{ $evidencePicture->order_id == $order->id ? 'selected' : '' }}>
                            {{ $order->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="sent_photo_url" class="block text-sm font-medium text-gray-700">Sent Photo URL</label>
                <input type="text" name="sent_photo_url" id="sent_photo_url" value="{{ $evidencePicture->sent_photo_url }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="received_photo_url" class="block text-sm font-medium text-gray-700">Received Photo URL</label>
                <input type="text" name="received_photo_url" id="received_photo_url" value="{{ $evidencePicture->received_photo_url }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="sent_at" class="block text-sm font-medium text-gray-700">Sent At</label>
                <input type="datetime-local" name="sent_at" id="sent_at" value="{{ date('Y-m-d\TH:i', strtotime($evidencePicture->sent_at)) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="received_at" class="block text-sm font-medium text-gray-700">Received At</label>
                <input type="datetime-local" name="received_at" id="received_at" value="{{ $evidencePicture->received_at ? date('Y-m-d\TH:i', strtotime($evidencePicture->received_at)) : '' }}" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="uploaded_by" class="block text-sm font-medium text-gray-700">Uploaded By</label>
                <input type="text" name="uploaded_by" id="uploaded_by" value="{{ $evidencePicture->uploaded_by }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('evidence_pictures.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>