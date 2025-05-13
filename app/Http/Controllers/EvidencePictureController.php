<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvidencePicture;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Storage;

class EvidencePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidencePictures = EvidencePicture::with(['order', 'uploader'])->latest()->get();
        return view('evidence_pictures.index', compact('evidencePictures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerOrders = CustomerOrder::whereDoesntHave('evidencePicture')->get();
        return view('evidence_pictures.create', compact('customerOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:customer_orders,id',
            'sent_photo' => 'required|image|max:2048', // máximo 2MB
        ]);

        // Guardar la imagen enviada
        $sentPhotoPath = $request->file('sent_photo')->store('evidence_pictures', 'public');

        // Crear el registro
        EvidencePicture::create([
            'order_id' => $request->order_id,
            'sent_photo_url' => $sentPhotoPath,
            'sent_at' => now(),
            'uploaded_by' => auth()->id(),
        ]);

        return to_route('evidence_pictures.index')->with('success', 'Evidence picture created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EvidencePicture $evidencePicture)
    {
        return view('evidence_pictures.show', compact('evidencePicture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvidencePicture $evidencePicture)
    {
        $customerOrders = CustomerOrder::all();
        return view('evidence_pictures.edit', compact('evidencePicture', 'customerOrders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvidencePicture $evidencePicture)
    {
        $request->validate([
            'received_photo' => 'nullable|image|max:2048', // máximo 2MB
            'received_at' => 'nullable|date',
            'order_id' => 'required|exists:customer_orders,id',
        ]);

        $data = [
            'order_id' => $request->order_id,
        ];

        // Si se está subiendo una foto de recepción
        if ($request->hasFile('received_photo')) {
            // Eliminar la foto anterior si existe
            if ($evidencePicture->received_photo_url) {
                Storage::disk('public')->delete($evidencePicture->getRawOriginal('received_photo_url'));
            }

            // Guardar la nueva foto
            $receivedPhotoPath = $request->file('received_photo')->store('evidence_pictures', 'public');
            $data['received_photo_url'] = $receivedPhotoPath;
            $data['received_at'] = now();
        } elseif ($request->filled('received_at')) {
            $data['received_at'] = $request->received_at;
        }

        // Si el estado de la orden es IN_ROUTE y se está confirmando la entrega
        if ($evidencePicture->order->status === 'IN_ROUTE' && $request->hasFile('received_photo')) {
            $evidencePicture->order->update(['status' => 'DELIVERED']);
        }

        $evidencePicture->update($data);

        return to_route('evidence_pictures.index')->with('success', 'Evidence picture updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvidencePicture $evidencePicture)
    {
        // Eliminar las imágenes del almacenamiento
        if ($evidencePicture->sent_photo_url) {
            Storage::disk('public')->delete($evidencePicture->sent_photo_url);
        }
        if ($evidencePicture->received_photo_url) {
            Storage::disk('public')->delete($evidencePicture->received_photo_url);
        }

        $evidencePicture->delete();
        return to_route('evidence_pictures.index')->with('success', 'Evidence picture deleted successfully.');
    }
}