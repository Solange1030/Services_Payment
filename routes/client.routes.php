<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/client/make_transaction', [ClientController::class, 'make_transaction']);
    Route::get('/client/view_details/{id}', [ClientController::class, 'view_details']);
    Route::get('/client/my_transactions', [ClientController::class, 'list_my_transaction']);
});
