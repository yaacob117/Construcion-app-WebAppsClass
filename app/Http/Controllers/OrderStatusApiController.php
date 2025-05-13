<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderStatusApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get order status and details by customer number and invoice number.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getOrderStatus(Request $request): JsonResponse
    {
        try {
            // Validar los parámetros de entrada
            $validated = $request->validate([
                'customer_number' => 'required|string',
                'invoice_number' => 'required|string'
            ]);

            // Buscar el cliente
            $customer = Customer::where('customerNumber', $validated['customer_number'])->first();
            
            if (!$customer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customer not found',
                    'error' => 'No customer found with the provided customer number'
                ], 404);
            }

            // Buscar la orden con sus productos y evidencias
            $order = CustomerOrder::where('invoice_number', $validated['invoice_number'])
                ->where('customer_number', $validated['customer_number'])
                ->with(['evidencePicture', 'orderProducts.product'])
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'error' => 'No order found with the provided invoice number for this customer'
                ], 404);
            }

            // Preparar la respuesta con toda la información necesaria
            $response = [
                'status' => 'success',
                'message' => 'Order status retrieved successfully',
                'data' => [
                    'customer' => [
                        'number' => $customer->customerNumber,
                        'name' => $customer->name,
                        'company' => $customer->companyName,
                        'fiscal_data' => $order->fiscal_data,
                        'delivery_address' => $order->delivery_address
                    ],
                    'order' => [
                        'invoice_number' => $order->invoice_number,
                        'status' => $order->status,
                        'order_date' => $order->order_date,
                        'notes' => $order->notes,
                        'total_amount' => $order->total_amount,
                        'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $order->updated_at->format('Y-m-d H:i:s'),
                        'status_description' => $this->getStatusDescription($order->status)
                    ],
                    'products' => []
                ]
            ];

            // Agregar los productos de la orden
            foreach ($order->orderProducts as $orderProduct) {
                $response['data']['products'][] = [
                    'name' => $orderProduct->product->name,
                    'quantity' => $orderProduct->quantity,
                    'unit_price' => $orderProduct->unit_price,
                    'total_price' => $orderProduct->total_price
                ];
            }

            // Agregar información de evidencia de entrega si existe y el estado es "DELIVERED"
            if ($order->status === 'DELIVERED' && $order->evidencePicture) {
                $response['data']['delivery_evidence'] = [
                    'sent_photo_url' => $order->evidencePicture->sent_photo_url,
                    'received_photo_url' => $order->evidencePicture->received_photo_url,
                    'sent_at' => $order->evidencePicture->sent_at?->format('Y-m-d H:i:s'),
                    'received_at' => $order->evidencePicture->received_at?->format('Y-m-d H:i:s')
                ];
            }

            return response()->json($response);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving order status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the description for each status.
     *
     * @param string $status
     * @return string
     */
    private function getStatusDescription(string $status): string
    {
        return match ($status) {
            'ORDERED' => 'The material is ordered and entered into the system by the sales executive.',
            'IN_PROCESS' => 'The order is in stock and being prepared for routing, or needs to be purchased from an external supplier.',
            'IN_ROUTE' => 'The order has been routed for distribution.',
            'DELIVERED' => 'The order has been delivered to the customer\'s premises.',
            default => 'Unknown status'
        };
    }
}
