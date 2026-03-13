<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::post('/client/make_transaction', [ClientController::class, 'make_transaction']);
Route::get('/client/my_transaction', [ClientController::class, 'list_my_transaction']);
Route::get('/client/view_details', [ClientController::class, 'view_details']);   
     