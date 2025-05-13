<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnterpriseOrder;

class EnterpriseOrderController extends Controller
{
    public function index()
    {
        $orders = EnterpriseOrder::where('is_deleted', false)->get();
        return view('enterprise_orders.index', compact('orders'));
    }

    public function create()
    {
        return view('enterprise_orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|unique:enterprise_orders,order_number',
            'supplier_name' => 'required|string|max:255',
            'supplier_contact' => 'required|string|max:255',
            'order_date' => 'required|date',
            'delivery_address' => 'required|string|max:255',
            'status' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        EnterpriseOrder::create($request->all());

        return redirect()->route('enterprise_orders.index')->with('success', 'Pedido creado exitosamente.');
    }

    public function show(EnterpriseOrder $enterpriseOrder)
    {
        return view('enterprise_orders.show', compact('enterpriseOrder'));
    }

    public function edit(EnterpriseOrder $enterpriseOrder)
    {
        return view('enterprise_orders.edit', compact('enterpriseOrder'));
    }

    public function update(Request $request, EnterpriseOrder $enterpriseOrder)
    {
        $request->validate([
            'order_number' => 'required|unique:enterprise_orders,order_number,' . $enterpriseOrder->id,
            'supplier_name' => 'required|string|max:255',
            'supplier_contact' => 'required|string|max:255',
            'order_date' => 'required|date',
            'delivery_address' => 'required|string|max:255',
            'status' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $enterpriseOrder->update($request->all());

        return redirect()->route('enterprise_orders.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    public function destroy(EnterpriseOrder $enterpriseOrder)
    {
        $enterpriseOrder->logicalDelete();
        return redirect()->route('enterprise_orders.index')->with('success', 'Pedido eliminado exitosamente.');
    }

    public function restore($id)
    {
        $enterpriseOrder = EnterpriseOrder::findOrFail($id);
        $enterpriseOrder->restore();
        return redirect()->route('enterprise_orders.index')->with('success', 'Pedido restaurado exitosamente.');
    }
}