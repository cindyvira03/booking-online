<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    // Cek ketersediaan item berdasarkan tanggal
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'date' => 'required|date',
        ]);

        $exists = Booking::where('item_id', $request->item_id)
            ->where('date', $request->date)
            ->whereIn('status', ['pending', 'confirmed']) // dianggap sudah dipakai
            ->exists();

        return response()->json([
            'available' => !$exists,
        ]);
    }
}
