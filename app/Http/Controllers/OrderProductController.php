<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\CustomerOrder;
use App\Models\Product;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_products = \App\Models\OrderProduct::with(['customer_order', 'enterprise_order', 'product'])->get();
        return view('order_products.index', compact('order_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Solo mostrar órdenes que pueden recibir productos
        $customer_orders = CustomerOrder::whereNotIn('status', ['DELIVERED', 'IN_ROUTE'])->get();
        $enterprise_orders = \App\Models\EnterpriseOrder::all();
        $products = Product::all();
        return view('order_products.create', compact('customer_orders', 'enterprise_orders', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderTypeAndId = explode('_', $request->order_id);
        $orderType = $orderTypeAndId[0];
        $orderId = $orderTypeAndId[1];

        if (!is_numeric($orderId)) {
            return back()->withErrors(['order_id' => 'Invalid order ID format.']);
        }

        // Verificar si es una orden de cliente y si puede recibir productos
        if ($orderType === 'customer') {
            $order = CustomerOrder::findOrFail($orderId);
            if (!$order->canAddProducts()) {
                return back()->withErrors(['order_id' => 'Cannot add products to completed or in-route orders.']);
            }
        }

        // Validar que haya productos
        if (!$request->has('products') || !is_array($request->products)) {
            return back()->withErrors(['products' => 'At least one product is required.']);
        }

        try {
            foreach ($request->products as $productData) {
                // Validar datos del producto
                if (empty($productData['product_id']) || empty($productData['quantity']) || empty($productData['unit_price'])) {
                    continue; // Skip invalid entries
                }

                // Calcular el total_price automáticamente
                $total_price = $productData['quantity'] * $productData['unit_price'];

                $orderProduct = OrderProduct::create([
                    'order_id' => $orderId,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['unit_price'],
                    'total_price' => $total_price,
                ]);
            }

            // Actualizar el total de la orden si es una orden de cliente
            if ($orderType === 'customer') {
                $order->updateTotalAmount();
            }

            return to_route('order_products.index')->with('success', 'Products added to order successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to add products to order: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_product = OrderProduct::find($id);
        return view('order_products.show', compact('order_product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order_product = OrderProduct::findOrFail($id);
        
        // Verificar si la orden puede ser editada
        if ($order_product->customer_order && !$order_product->customer_order->canAddProducts()) {
            return back()->withErrors(['error' => 'Cannot edit products of completed or in-route orders.']);
        }

        $customer_orders = CustomerOrder::whereNotIn('status', ['DELIVERED', 'IN_ROUTE'])->get();
        $products = Product::all();
        return view('order_products.edit', compact('order_product', 'customer_orders', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order_product = OrderProduct::find($id);

        // Verificar si la orden puede ser editada
        if ($order_product->customer_order && !$order_product->customer_order->canAddProducts()) {
            return back()->withErrors(['error' => 'Cannot edit products of completed or in-route orders.']);
        }

        // Calcular el total_price automáticamente
        $total_price = $request->quantity * $request->unit_price;

        $order_product->update([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $total_price,
        ]);

        // Actualizar el total de la orden si es una orden de cliente
        if ($order_product->customer_order) {
            $order_product->customer_order->updateTotalAmount();
        }

        return to_route('order_products.index')->with('success', 'Order product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_product = OrderProduct::find($id);

        // Verificar si la orden puede ser editada
        if ($order_product->customer_order && !$order_product->customer_order->canAddProducts()) {
            return back()->withErrors(['error' => 'Cannot delete products from completed or in-route orders.']);
        }

        $order_product->delete();

        // Actualizar el total de la orden si es una orden de cliente
        if ($order_product->customer_order) {
            $order_product->customer_order->updateTotalAmount();
        }

        return to_route('order_products.index')->with('success', 'Order product deleted successfully.');
    }
}
