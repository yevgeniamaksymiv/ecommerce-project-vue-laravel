<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\DeliveryController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('users/register', [UserController::class, 'register']);
Route::post('users/login', [UserController::class, 'login']);
Route::get('users/logout', [UserController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('products/search', [ProductController::class, 'search']);
Route::post('products/filter', [ProductController::class, 'filter']);
Route::get('products/colors_sizes', [ProductController::class, 'getColorsSizes']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);


Route::get('categories', [CategoryController::class, 'index']);
Route::get('deliveries', [DeliveryController::class, 'index']);

Route::get('orders', [OrderController::class, 'index']);
Route::post('orders/store', [OrderController::class, 'store']);

