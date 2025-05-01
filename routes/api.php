<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

Route::apiResource('rooms', RoomController::class);
Route::get('/rooms/booking/{room_id}', [RoomController::class, 'bookingsByRoom']);
