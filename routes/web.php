<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\EnterpriseOrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\EvidencePictureController;
use App\Http\Controllers\FIleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\EnterpriseOrder;
use App\Models\EvidencePicture;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('customer_orders', CustomerOrderController::class);
Route::resource('order_products', OrderProductController::class);
Route::resource('evidence_pictures', EvidencePictureController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('enterprise_orders', EnterpriseOrderController::class);

Route::get('customers/{customer}/order-status/{invoiceNumber}', [CustomerController::class, 'getOrderStatus'])->name('customers.order-status');

Route::post('/upload', [FileController::class, 'upload'])->name('upload');
Route::post('/download/{path}', [FileController::class, 'download'])->name('download');
Route::get('/form', function () {
    $evidence = EvidencePicture::latest()->first();
    $path = $evidence ? $evidence->sent_photo_url : null;

    return view('form', compact('path'));
})->name('form');