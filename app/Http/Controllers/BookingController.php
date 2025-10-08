<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
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

        $available = !$exists;

        return response()->json([
            'available' => $available,
            'message'   => $available
                ? 'Item tersedia, silakan lanjut checkout.'
                : 'Item tidak tersedia pada tanggal ini.',
        ]);
    }

    // Form booking untuk item tertentu
    public function create(Item $item)
    {
        return view('pages.bookings.create', compact('item'));
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
        $booking = Booking::create([
            'user_id'      => Auth::id(),                // user login
            'item_id'      => $item->id,
            'booking_code' => 'BK-' . strtoupper(uniqid()), // kode unik
            'snap_token'   => null,                      // kalau nanti mau pakai payment gateway
            'date'         => $request->date,
            'duration'     => $request->duration,
            'total'        => $item->price,              // total dari harga item
            'dp'           => $request->dp ?? 0,         // DP user, default 0
            'fine'         => 0,                         // denda default 0
            'delay'        => 0,                         // keterlambatan default 0
            'status'       => 'pending',                 // default pending
        ]);


        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibuat!');
    }
}
