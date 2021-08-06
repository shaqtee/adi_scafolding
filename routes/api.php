<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BankSwiftController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Midtrans Payment Gateway API Route
|--------------------------------------------------------------------------
|
*/


Route::post('/member/deposit', [PaymentController::class, 'deposit']);
Route::post('/midtrans/notification', [PaymentController::class, 'notification']);

/* List Banks */
Route::post('/bankswifts', [BankSwiftController::class, 'index']);
