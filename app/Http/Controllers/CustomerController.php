<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'customerNumber' => 'required|unique:customers',
            'address' => 'required',
            'companyName' => 'nullable',
            'fiscalData' => 'nullable',
        ]);

        Customer::create($request->only([
            'customerNumber',
            'name',
            'companyName',
            'fiscalData',
            'address',
        ]));
        
        return to_route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        if (method_exists(Customer::class, 'customerOrders')) {
            $customer = Customer::with('customerOrders')->findOrFail($id);
        } else {
            $customer = Customer::findOrFail($id);
        }
        
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'customerNumber' => 'required|unique:customers,customerNumber,'.$id,
            'address' => 'required',
            'companyName' => 'nullable',
            'fiscalData' => 'nullable',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->only([
            'customerNumber',
            'name',
            'companyName',
            'fiscalData',
            'address',
        ]));
        
        return to_route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        
        return to_route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    /**
     * Get order status for a specific customer and invoice number.
     *
     * @param  \App\Models\Customer  $customer
     * @param  string  $invoiceNumber
     * @return \Illuminate\Http\Response
     */
    public function getOrderStatus(Customer $customer, $invoiceNumber)
    {
        if (method_exists($customer, 'customerOrders')) {
            $order = $customer->customerOrders()
                ->where('invoice_number', $invoiceNumber)
                ->firstOrFail();
            
            return view('customers.order-status', compact('customer', 'order'));
        } else {
            return redirect()->route('customers.show', $customer->id)
                ->with('error', 'Order relationship not implemented yet.');
        }
    }
}