<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

// Customers
Route::get('customers', [CustomerController::class, 'indexApi'])->middleware('auth');

Route::post('customers', [CustomerController::class, 'storeApi'])->middleware('auth');

Route::put('customers/{customer}', [CustomerController::class, 'updateApi'])->middleware('auth');

Route::delete('customers/{customer}', [CustomerController::class, 'destroyApi'])->middleware('auth');
