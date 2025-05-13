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

        <form action="{{ route('evidence_pictures.update', $evidencePicture->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6">
                <label for="order_id" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <select name="order_id" id="order_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @foreach($customerOrders as $order)
                        <option value="{{ $order->id }}" {{ $evidencePicture->order_id == $order->id ? 'selected' : '' }}>
                            Order #{{ $order->id }} - {{ $order->customer->name }} ({{ $order->invoice_number }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sent Photo Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Sent Photo</h3>
                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-2">
                    <img src="{{ $evidencePicture->sent_photo_url }}" 
                         alt="Sent Photo" 
                         class="w-full h-full object-contain">
                </div>
                <p class="text-sm text-gray-600">
                    Sent at: {{ $evidencePicture->sent_at->format('M d, Y H:i') }}
                </p>
            </div>

            <!-- Received Photo Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Received Photo</h3>
                @if($evidencePicture->received_photo_url)
                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                        <img src="{{ $evidencePicture->received_photo_url }}" 
                             alt="Received Photo" 
                             class="w-full h-full object-contain">
                    </div>
                @endif

                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                  stroke-width="2" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="received_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload a new photo</span>
                                <input id="received_photo" 
                                       name="received_photo" 
                                       type="file" 
                                       class="sr-only" 
                                       accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="received_at" class="block text-sm font-medium text-gray-700">Received At</label>
                    <input type="datetime-local" 
                           name="received_at" 
                           id="received_at" 
                           value="{{ $evidencePicture->received_at ? date('Y-m-d\TH:i', strtotime($evidencePicture->received_at)) : '' }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md">
                    <p class="mt-1 text-sm text-gray-500">
                        Leave empty to use current time when uploading a new photo
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('evidence_pictures.index') }}" 
                   class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors">
                    Update Evidence
                </button>
            </div>
        </form>
    </div>

    <script>
        // Preview de imagen
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('received_photo');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.createElement('img');
                            preview.src = e.target.result;
                            preview.className = 'w-full h-full object-contain';
                            
                            const container = document.querySelector('.aspect-video');
                            const existingPreview = container.querySelector('img');
                            if (existingPreview) {
                                existingPreview.remove();
                            }
                            container.appendChild(preview);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</body>
</html>