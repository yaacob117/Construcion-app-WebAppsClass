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

//Cambios de Jorge
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerControllerAPI;
use App\Http\Controllers\Api\CustomerOrderControllerAPI;
use App\Http\Controllers\Api\EnterpriseOrderControllerAPI;
use App\Http\Controllers\Api\EvidencePictureControllerAPI;

Route::resource('customers', CustomerControllerAPI::class);
Route::resource('customer-orders', CustomerOrderControllerAPI::class);
Route::resource('enterprise-orders', EnterpriseOrderControllerAPI::class);
Route::resource('evidence-pictures', EvidencePictureControllerAPI::class);