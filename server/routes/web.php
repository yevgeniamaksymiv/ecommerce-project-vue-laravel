<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/', '/login');

Route::get('/admin', function () {
    return view('layouts/sidebar');
});

Route::prefix('admin')->middleware('adminUsers')->group( function () {
    Route::resources([
        'categories' => CategoryController::class,
        'deliveries' => DeliveryController::class,
        'orders' => OrderController::class,
        'products' => ProductController::class,
        'roles' => RoleController::class,
        'users' => UserController::class
    ]);
    Route::post('orders', [OrderController::class, 'ordersInPeriod'])->name('orders.in_period');
    Route::get('export', [OrderController::class, 'export'])->name('orders.export');
    Route::get('generate_pdf', [OrderController::class, 'generatePdf'])->name('orders.generate_pdf');
//    Route::post('restore', [OrderController::class, 'restore'])->name('orders.restore');
});





