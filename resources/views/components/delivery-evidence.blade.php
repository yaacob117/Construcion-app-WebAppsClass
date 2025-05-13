@props(['order'])

<div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Delivery Evidence</h2>
    
    @if($order->hasDeliveryEvidence())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Sent Photo -->
            <div>
                <h3 class="text-lg font-medium mb-2">Sent Photo</h3>
                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ $order->evidencePicture->sent_photo_url }}" 
                         alt="Sent Photo" 
                         class="w-full h-full object-cover">
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    Sent at: {{ $order->evidencePicture->sent_at->format('M d, Y H:i') }}
                </p>
            </div>

            <!-- Received Photo -->
            <div>
                <h3 class="text-lg font-medium mb-2">Received Photo</h3>
                @if($order->isDeliveryConfirmed())
                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ $order->evidencePicture->received_photo_url }}" 
                             alt="Received Photo" 
                             class="w-full h-full object-cover">
                    </div>
                    <p class="mt-2 text-sm text-gray-600">
                        Received at: {{ $order->evidencePicture->received_at->format('M d, Y H:i') }}
                    </p>
                @else
                    <div class="aspect-video bg-gray-100 rounded-lg flex items-center justify-center">
                        <p class="text-gray-500">Waiting for delivery confirmation...</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Information -->
        <div class="mt-4 p-4 rounded-lg
            @if($order->isDeliveryConfirmed()) 
                bg-green-100 
            @else 
                bg-yellow-100
            @endif">
            <p class="font-medium
                @if($order->isDeliveryConfirmed()) 
                    text-green-800 
                @else 
                    text-yellow-800
                @endif">
                @if($order->isDeliveryConfirmed())
                    ✓ Delivery confirmed
                @else
                    ⚠ Waiting for delivery confirmation
                @endif
            </p>
        </div>

        @if(!$order->isDeliveryConfirmed() && auth()->user()->hasRole('Customer'))
            <div class="mt-4">
                <form action="{{ route('evidence_pictures.update', $order->evidencePicture->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="received_photo" class="block text-sm font-medium text-gray-700">Upload Confirmation Photo</label>
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
                                        <span>Upload a file</span>
                                        <input id="received_photo" 
                                               name="received_photo" 
                                               type="file" 
                                               class="sr-only" 
                                               accept="image/*" 
                                               required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors">
                            Confirm Delivery
                        </button>
                    </div>
                </form>
            </div>
        @endif
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">No delivery evidence available yet.</p>
            @if(auth()->user()->hasRole('Warehouse'))
                <a href="{{ route('evidence_pictures.create', ['order_id' => $order->id]) }}" 
                   class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors">
                    Upload Delivery Evidence
                </a>
            @endif
        </div>
    @endif
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
                        preview.className = 'mt-4 mx-auto h-48 w-auto';
                        
                        const previewContainer = fileInput.closest('div').querySelector('.space-y-1');
                        const existingPreview = previewContainer.querySelector('img');
                        if (existingPreview) {
                            existingPreview.remove();
                        }
                        previewContainer.appendChild(preview);
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script> 