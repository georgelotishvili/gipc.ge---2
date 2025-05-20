<?php

use App\Http\Controllers\API\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});
