<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::apiResource('customers', CustomerController::class);
Route::get('/customers/booking/{customer_id}', [CustomerController::class, 'bookingsByCustomer']);