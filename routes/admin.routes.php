<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/admin/clients', [AdminController::class, 'list_clients']);
Route::get('/admin/transactions/pending', [AdminController::class, 'list_pending_transactions']);
Route::get('/admin/transactions/failed', [AdminController::class, 'list_faild_transactions']);
Route::get('/admin/transactions/paid', [AdminController::class, 'list_payed_transactions']);
Route::post('/admin/transaction/cancel', [AdminController::class, 'cancel_transaction']);
Route::post('/admin/transaction/update-status', [AdminController::class, 'update_transaction_status']);
