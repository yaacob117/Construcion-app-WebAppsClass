<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\EnterpriseOrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\EvidencePictureController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\EnterpriseOrder;
use App\Models\EvidencePicture;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas accesibles por Administrador y Ventas
    Route::middleware(['role:Administrator,Sales'])->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('customer_orders', CustomerOrderController::class);
        Route::get('customers/{customer}/order-status/{invoiceNumber}', [CustomerController::class, 'getOrderStatus'])
            ->name('customers.order-status');
    });

    // Rutas accesibles por Administrador y Compras
    Route::middleware(['role:Administrator,Purchasing'])->group(function () {
        Route::resource('enterprise_orders', EnterpriseOrderController::class);
    });

    // Rutas accesibles por Administrador, Ventas y Compras
    Route::middleware(['role:Administrator,Sales,Purchasing'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('order_products', OrderProductController::class);
    });

    // Rutas accesibles por Administrador y Almacén
    Route::middleware(['role:Administrator,Warehouse'])->group(function () {
        Route::resource('evidence_pictures', EvidencePictureController::class);
        Route::post('/upload', [FileController::class, 'upload'])->name('upload');
        Route::post('/download/{path}', [FileController::class, 'download'])->name('download');
    });

    // Rutas accesibles por Administrador y Rutas
    Route::middleware(['role:Administrator,Routes'])->group(function () {
        Route::get('/form', function () {
            $evidence = EvidencePicture::latest()->first();
            $path = $evidence ? $evidence->sent_photo_url : null;
            return view('form', compact('path'));
        })->name('form');
    });

    // Rutas solo accesibles por Administrador
    Route::middleware(['role:Administrator'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});