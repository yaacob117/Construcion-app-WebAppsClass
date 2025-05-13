<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvidencePicture;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileApiController extends Controller
{
    /**
     * Upload a file and create an evidence record.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'archivo' => 'required|file|image|max:2048', // Restringido a imágenes
            'order_id' => 'required|exists:customer_orders,id',
            'uploaded_by' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $archivo = $request->file('archivo');
            $filename = time() . '_' . Str::slug(pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $archivo->getClientOriginalExtension();
            $path = $archivo->storeAs('imagenes', $filename, 'public');

            $evidence = new EvidencePicture();
            $evidence->order_id = $request->order_id;
            $evidence->sent_photo_url = $path;
            $evidence->sent_at = now();
            $evidence->uploaded_by = $request->input('uploaded_by', auth()->user()->name ?? 'default_user');
            $evidence->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Archivo subido exitosamente',
                'data' => [
                    'evidence_id' => $evidence->id,
                    'path' => $path,
                    'url' => asset('storage/' . $path),
                    'sent_at' => $evidence->sent_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al subir el archivo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all evidence pictures for a specific order.
     *
     * @param int $orderId
     * @return JsonResponse
     */
    public function getEvidenceByOrder(int $orderId): JsonResponse
    {
        try {
            $evidence = EvidencePicture::where('order_id', $orderId)->get();

            // Agregar URLs completas a las imágenes
            $evidence->each(function ($item) {
                $item->full_url = asset('storage/' . $item->sent_photo_url);
            });

            return response()->json([
                'status' => 'success',
                'data' => $evidence
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener las evidencias',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download a file by its path.
     *
     * @param string $path
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\JsonResponse
     */
    public function download(string $path)
    {
        $path = 'public/' . $path;

        if (!Storage::exists($path)) {
            return response()->json([
                'status' => 'error',
                'message' => 'El archivo no existe'
            ], 404);
        }

        try {
            return Storage::download($path);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al descargar el archivo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an evidence picture.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $evidence = EvidencePicture::findOrFail($id);

            // Eliminar archivo físico
            if (Storage::exists('public/' . $evidence->sent_photo_url)) {
                Storage::delete('public/' . $evidence->sent_photo_url);
            }

            $evidence->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Evidencia eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar la evidencia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single evidence picture.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $evidence = EvidencePicture::findOrFail($id);
            $evidence->full_url = asset('storage/' . $evidence->sent_photo_url);

            return response()->json([
                'status' => 'success',
                'data' => $evidence
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Evidencia no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
