<?php

namespace App\Http\Controllers;

use App\Models\EvidencePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FIleController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'archivo' => 'required|file|max:2048',
            'order_id' => 'required|exists:customer_orders,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $archivo = $request->file('archivo');
        $path = $archivo->store('imagenes', 'public');

        $evidence = new EvidencePicture();
        $evidence->order_id = $request->order_id;
        $evidence->sent_photo_url = $path;
        $evidence->sent_at = now();
        $evidence->uploaded_by = 'default_user';
        $evidence->save();

        return response()->json(['message' => 'Archivo subido exitosamente', 'path' => $path], 201);
    }

    public function download($path)
    {
        return Storage::download($path);
    }
}
