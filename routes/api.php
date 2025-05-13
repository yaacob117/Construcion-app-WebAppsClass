<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\OrderStatusApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});

// Customer routes
Route::get('/apicustomers', [CustomerApiController::class, 'index']);
Route::get('/apicustomers/{id}', [CustomerApiController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/apicustomers', [CustomerApiController::class, 'store']);
    Route::put('/apicustomers/{id}', [CustomerApiController::class, 'update']);
    Route::delete('/apicustomers/{id}', [CustomerApiController::class, 'destroy']);
    Route::get('/apicustomers/{customer}/order-status/{invoiceNumber}', [CustomerApiController::class, 'getOrderStatus']);
});

// Order Status route
Route::get('/order-status', [OrderStatusApiController::class, 'getOrderStatus']); 