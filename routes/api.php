<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\OrderProductApiController;

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

Route::apiResource('order-products', 'App\Http\Controllers\Api\OrderProductApiController');
Route::get('orders/{orderType}/{orderId}/products', 'App\Http\Controllers\Api\OrderProductApiController@getProductsByOrder');


Route::post('upload', 'App\Http\Controllers\Api\FileApiController@upload');
Route::get('download/{path}', 'App\Http\Controllers\Api\FileApiController@download')->where('path', '.*');
Route::get('evidence/order/{orderId}', 'App\Http\Controllers\Api\FileApiController@getEvidenceByOrder');
Route::get('evidence/{id}', 'App\Http\Controllers\Api\FileApiController@show');
Route::delete('evidence/{id}', 'App\Http\Controllers\Api\FileApiController@destroy');
