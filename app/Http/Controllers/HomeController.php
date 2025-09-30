<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Tampilkan semua layanan yang bisa dibooking
    public function index()
    {
        $items = Item::with('category', 'images')->get();
        return view('home.index', compact('items'));
    }

    // Tampilkan detail item
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('home.show', compact('item'));
    }

    // Lihat history booking user login
    public function history(Request $request)
    {
        $status = $request->query('status'); // ?status=pending dll

        $bookings = Booking::with('item')
            ->where('user_id', Auth::id())
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('home.history', compact('bookings', 'status'));
    }
}
