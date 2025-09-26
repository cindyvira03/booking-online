<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class HistoryBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'item'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }
}
