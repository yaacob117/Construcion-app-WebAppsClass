<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvidencePicture;
use App\Models\CustomerOrder;

class EvidencePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidencePictures = EvidencePicture::all();
        return view('evidence_pictures.index', compact('evidencePictures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerOrders = CustomerOrder::all();
        return view('evidence_pictures.create', compact('customerOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        EvidencePicture::create([
            'order_id' => $request->order_id,
            'sent_photo_url' => $request->sent_photo_url,
            'received_photo_url' => $request->received_photo_url,
            'sent_at' => $request->sent_at,
            'received_at' => $request->received_at,
            'uploaded_by' => $request->uploaded_by,
        ]);

        return to_route('evidence_pictures.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evidencePicture = EvidencePicture::find($id);
        return view('evidence_pictures.show', compact('evidencePicture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evidencePicture = EvidencePicture::find($id);
        $customerOrders = CustomerOrder::all();
        return view('evidence_pictures.edit', compact('evidencePicture', 'customerOrders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $evidencePicture = EvidencePicture::find($id);
        $evidencePicture->update([
            'order_id' => $request->order_id,
            'sent_photo_url' => $request->sent_photo_url,
            'received_photo_url' => $request->received_photo_url,
            'sent_at' => $request->sent_at,
            'received_at' => $request->received_at,
            'uploaded_by' => $request->uploaded_by,
        ]);

        return to_route('evidence_pictures.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evidencePicture = EvidencePicture::find($id);
        $evidencePicture->delete();
        return to_route('evidence_pictures.index');
    }
}