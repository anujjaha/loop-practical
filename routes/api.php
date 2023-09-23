<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Order\APIOrdersController;
use App\Http\Controllers\Api\OrderDetail\APIOrderDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('orders', APIOrdersController::class);

// Add product to Order
Route::post("orders/{id}/add", [APIOrderDetailsController::class, 'addProduct'])->name("order.order-details.add-product");

// Pay Order
Route::post("orders/{id}/pay", [APIOrdersController::class, 'pay'])->name("order.pay");