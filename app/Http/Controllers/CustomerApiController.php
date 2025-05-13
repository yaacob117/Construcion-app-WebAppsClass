<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('customerOrders')->get();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'customerNumber' => 'required|unique:customers',
            'address' => 'required',
            'companyName' => 'nullable',
            'fiscalData' => 'nullable',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::with('customerOrders')->findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'customerNumber' => 'required|unique:customers,customerNumber,'.$id,
            'address' => 'required',
            'companyName' => 'nullable',
            'fiscalData' => 'nullable',
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }

    /**
     * Get order status for a specific customer and invoice number.
     */
    public function getOrderStatus(Customer $customer, string $invoiceNumber)
    {
        $order = $customer->customerOrders()
            ->where('invoice_number', $invoiceNumber)
            ->firstOrFail();
        
        return response()->json([
            'customer' => $customer,
            'order' => $order
        ]);
    }
}
