<?php

use App\Http\Controllers\Api\BookingApiController;
use Illuminate\Support\Facades\Route;

Route::get('/bookings/check-availability', [BookingApiController::class, 'checkAvailability']);
