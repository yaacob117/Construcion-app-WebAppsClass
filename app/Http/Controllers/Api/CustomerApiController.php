<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $customers = Customer::with('customerOrders')->get();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Customers retrieved successfully',
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'customerNumber' => 'required|unique:customers',
                'address' => 'required',
                'companyName' => 'nullable',
                'fiscalData' => 'nullable',
            ]);

            $customer = Customer::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully',
                'data' => $customer
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $customer = Customer::with('customerOrders')->findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Customer retrieved successfully',
                'data' => $customer
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found',
                'error' => 'The requested customer does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required',
                'customerNumber' => 'required|unique:customers,customerNumber,'.$id,
                'address' => 'required',
                'companyName' => 'nullable',
                'fiscalData' => 'nullable',
            ]);

            $customer->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully',
                'data' => $customer
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found',
                'error' => 'The requested customer does not exist'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found',
                'error' => 'The requested customer does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order status for a specific customer and invoice number.
     */
    public function getOrderStatus(Customer $customer, string $invoiceNumber): JsonResponse
    {
        try {
            $order = $customer->customerOrders()
                ->where('invoice_number', $invoiceNumber)
                ->firstOrFail();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Order status retrieved successfully',
                'data' => [
                    'customer' => $customer,
                    'order' => $order
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
                'error' => 'The requested order does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving order status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
