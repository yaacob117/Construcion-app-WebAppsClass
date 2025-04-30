<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\View;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = CustomerOrder::all();
        return view('customer_orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = \App\Models\Customer::all();
        return view('customer_orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        CustomerOrder::create([
            'invoice_number' => $request->invoice_number,
            'customer_number' => $request->customer_number,
            'customer_name' => $request->customer_name,
            'fiscal_data' => $request->fiscal_data,
            'order_date' => $request->order_date,
            'delivery_address' => $request->delivery_address,
            'notes' => $request->notes,
            'status' => $request->status,
            'total_amount' => $request->total_amount,
        ]);
        return to_route('customer_orders.index');
    }

    public function show(string $id)
    {
        $order = CustomerOrder::findOrFail($id);
        return view('customer_orders.show', compact('order'));
    }

    public function edit(string $id)
    {
        $order = CustomerOrder::findOrFail($id);
        $customers = \App\Models\Customer::all();
        return view('customer_orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, string $id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->update([
            'invoice_number' => $request->invoice_number,
            'customer_number' => $request->customer_number,
            'customer_name' => $request->customer_name,
            'fiscal_data' => $request->fiscal_data,
            'order_date' => $request->order_date,
            'delivery_address' => $request->delivery_address,
            'notes' => $request->notes,
            'status' => $request->status,
            'total_amount' => $request->total_amount,
        ]);
        return to_route('customer_orders.index');
    }

    public function destroy(string $id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();
        return to_route('customer_orders.index');
    }
}
