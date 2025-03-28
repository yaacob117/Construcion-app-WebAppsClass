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
        $order_products = OrderProduct::all();
        return view('order_products.index', compact('order_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer_orders = CustomerOrder::all();
        $products =  Product::all();
        return view('order_products.create', compact('customer_orders', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        OrderProduct::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
        ]);
        return to_route('order_products.index');
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
        $order_product = OrderProduct::find($id);
        $customer_orders = CustomerOrder::all();
        $products =  Product::all();
        return view('order_products.edit', compact('order_product', 'customer_orders', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order_product = OrderProduct::find($id);
        $order_product->update([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
        ]);
        return to_route('order_products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_product = OrderProduct::find($id);
        $order_product->delete();
        return to_route('order_products.index');
    }
}
