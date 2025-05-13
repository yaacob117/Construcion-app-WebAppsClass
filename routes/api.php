<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Test route
Route::get('/apitest', function() {
    return response()->json(['message' => 'API is working']);
});

// Customer routes - direct definition without groups
Route::get('/apicustomers', [CustomerApiController::class, 'index']);
Route::post('/apicustomers', [CustomerApiController::class, 'store']);
Route::get('/apicustomers/{id}', [CustomerApiController::class, 'show']);
Route::put('/apicustomers/{id}', [CustomerApiController::class, 'update']);
Route::delete('/apicustomers/{id}', [CustomerApiController::class, 'destroy']);
Route::get('/apicustomers/{customer}/order-status/{invoiceNumber}', [CustomerApiController::class, 'getOrderStatus']); 