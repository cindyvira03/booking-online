<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan semua layanan yang bisa dibooking
    public function index()
    {
        $items = Item::with('category', 'images')->get();
        return view('bookings.index', compact('items'));
    }

    // Form booking untuk item tertentu
    public function create(Item $item)
    {
        return view('bookings.create', compact('item'));
    }

    // Simpan booking
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'item_id'   => 'required|exists:items,id',
            'date'      => 'required|date|after_or_equal:today',
            'duration'  => 'required|integer|min:1',
            'dp'        => 'nullable|numeric|min:0',
        ], [
            'item_id.required' => 'Item harus dipilih.',
            'item_id.exists'   => 'Item yang dipilih tidak valid.',
            'date.required'    => 'Tanggal booking wajib diisi.',
            'date.after_or_equal' => 'Tanggal booking minimal hari ini.',
            'duration.required' => 'Durasi sewa wajib diisi.',
            'duration.min'     => 'Durasi minimal 1 hari.',
        ]);

        // Ambil item berdasarkan ID
        $item = Item::findOrFail($request->item_id);

        // Buat booking baru
        $booking = new Booking();
        $booking->user_id   = Auth::id();          // user login
        $booking->item_id   = $item->id;
        $booking->booking_code = 'BK-' . strtoupper(uniqid()); // kode unik
        $booking->snap_token = null;                 // kalau nanti mau pakai payment gateway
        $booking->date      = $request->date;
        $booking->duration  = $request->duration;
        $booking->total     = $item->price;          // total dari harga item
        $booking->dp        = $request->dp ?? 0;     // DP user, default 0
        $booking->fine      = 0;                     // denda dasar (misal kerusakan) default 0
        $booking->delay     = 0;                     // lama keterlambatan, default 0
        $booking->status    = 'pending';             // default pending

        $booking->save();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibuat!');
    }
}
