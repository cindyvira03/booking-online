<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'user_id'      => 2,
                'item_id'      => 10,
                'booking_code' => strtoupper(Str::random(8)),
                'snap_token'   => Str::random(20),
                'date'         => now()->addDays(2),
                'duration'     => 3, // misalnya 3 hari
                'total'        => 300000,
                'dp'           => 100000,
                'fine'         => 0,
                'delay'        => 0,
                'status'       => 'pending',
            ],
            [
                'user_id'      => 2,
                'item_id'      => 12,
                'booking_code' => strtoupper(Str::random(8)),
                'snap_token'   => Str::random(20),
                'date'         => now()->addDays(5),
                'duration'     => 5,
                'total'        => 500000,
                'dp'           => 200000,
                'fine'         => 0,
                'delay'        => 0,
                'status'       => 'confirmed',
            ],
            [
                'user_id'      => 2,
                'item_id'      => 10,
                'booking_code' => strtoupper(Str::random(8)),
                'snap_token'   => Str::random(20),
                'date'         => now()->subDays(3),
                'duration'     => 2,
                'total'        => 200000,
                'dp'           => 100000,
                'fine'         => 50000,
                'delay'        => 1,
                'status'       => 'completed',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
