<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\EnterpriseOrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\EvidencePictureController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas accesibles por Administrador y Ventas
    Route::middleware(CheckRole::class . ':Administrator,Sales')->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('customer_orders', CustomerOrderController::class);
        Route::get('customers/{customer}/order-status/{invoiceNumber}', [CustomerController::class, 'getOrderStatus'])
            ->name('customers.order-status');
    });

    // Rutas accesibles por Administrador y Compras
    Route::middleware(CheckRole::class . ':Administrator,Purchasing')->group(function () {
        Route::resource('enterprise_orders', EnterpriseOrderController::class);
    });

    // Rutas accesibles por Administrador, Ventas y Compras
    Route::middleware(CheckRole::class . ':Administrator,Sales,Purchasing')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('order_products', OrderProductController::class);
    });

    // Rutas accesibles por Administrador y Almacén
    Route::middleware(CheckRole::class . ':Administrator,Warehouse')->group(function () {
        Route::resource('evidence_pictures', EvidencePictureController::class);
        Route::post('/upload', [FileController::class, 'upload'])->name('upload');
        Route::get('/download/{path}', [FileController::class, 'download'])->name('download');
    });

    // Rutas accesibles por Administrador y Rutas
    Route::middleware(CheckRole::class . ':Administrator,Routes')->group(function () {
        Route::get('/form', function () {
            $evidence = \App\Models\EvidencePicture::latest()->first();
            $path = $evidence ? $evidence->sent_photo_url : null;
            return view('form', compact('path'));
        })->name('form');
    });

    // Rutas solo accesibles por Administrador
    Route::middleware(CheckRole::class . ':Administrator')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';
