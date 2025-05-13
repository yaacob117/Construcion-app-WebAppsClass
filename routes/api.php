<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\Api\OrderStatusApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Test route
Route::get('api/test', function() {
    return response()->json(['message' => 'API is working']);
});

// Customer routes
Route::get('api/customers', [CustomerApiController::class, 'index']);
Route::post('api/customers', [CustomerApiController::class, 'store']);
Route::get('api/customers/{id}', [CustomerApiController::class, 'show']);
Route::put('api/customers/{id}', [CustomerApiController::class, 'update']);
Route::delete('api/customers/{id}', [CustomerApiController::class, 'destroy']);
Route::get('api/customers/{customer}/order-status/{invoiceNumber}', [CustomerApiController::class, 'getOrderStatus']);

// Order Status route
Route::get('/order-status', [OrderStatusApiController::class, 'getOrderStatus']); 