<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\CustomerOrder;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class OrderProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $order_products = OrderProduct::with(['customer_order', 'enterprise_order', 'product'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $order_products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Validar datos de entrada
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderTypeAndId = explode('_', $request->order_id);

        if (count($orderTypeAndId) !== 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid order ID format'
            ], 422);
        }

        $orderType = $orderTypeAndId[0];
        $orderId = $orderTypeAndId[1];

        if (!is_numeric($orderId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid order ID'
            ], 422);
        }

        // Verificar si es una orden de cliente y si puede recibir productos
        if ($orderType === 'customer') {
            $order = CustomerOrder::find($orderId);

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customer order not found'
                ], 404);
            }

            if (!$order->canAddProducts()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot add products to completed or in-route orders'
                ], 422);
            }
        } elseif ($orderType === 'enterprise') {
            $order = \App\Models\EnterpriseOrder::find($orderId);

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Enterprise order not found'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid order type'
            ], 422);
        }

        // Calcular el total_price automáticamente
        $total_price = $request->quantity * $request->unit_price;

        try {
            $orderProduct = OrderProduct::create([
                'order_type' => $orderType,
                'order_id' => $orderId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total_price' => $total_price,
            ]);

            // Actualizar el total de la orden si es una orden de cliente
            if ($orderType === 'customer') {
                $order->updateTotalAmount();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to order successfully',
                'data' => $orderProduct
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add product to order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $order_product = OrderProduct::with(['customer_order', 'enterprise_order', 'product'])->find($id);

        if (!$order_product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order product not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $order_product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $order_product = OrderProduct::find($id);

        if (!$order_product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order product not found'
            ], 404);
        }

        // Validar datos de entrada
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verificar si la orden puede ser editada
        if ($order_product->customer_order && !$order_product->customer_order->canAddProducts()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot edit products of completed or in-route orders'
            ], 422);
        }

        // Calcular el total_price automáticamente
        $total_price = $request->quantity * $request->unit_price;

        try {
            $order_product->update([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total_price' => $total_price,
            ]);

            // Actualizar el total de la orden si es una orden de cliente
            if ($order_product->customer_order) {
                $order_product->customer_order->updateTotalAmount();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order product updated successfully',
                'data' => $order_product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update order product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $order_product = OrderProduct::find($id);

        if (!$order_product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order product not found'
            ], 404);
        }

        // Verificar si la orden puede ser editada
        if ($order_product->customer_order && !$order_product->customer_order->canAddProducts()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete products from completed or in-route orders'
            ], 422);
        }

        try {
            // Guardar la referencia a customer_order antes de eliminar
            $customerOrder = $order_product->customer_order;

            $order_product->delete();

            // Actualizar el total de la orden si es una orden de cliente
            if ($customerOrder) {
                $customerOrder->updateTotalAmount();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order product deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete order product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by order.
     *
     * @param string $orderType
     * @param int $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsByOrder(string $orderType, int $orderId): JsonResponse
    {
        $order_products = OrderProduct::where('order_type', $orderType)
            ->where('order_id', $orderId)
            ->with('product')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $order_products
        ]);
    }
}
