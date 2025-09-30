<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Booking
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mb-4">
            <form method="GET" action="{{ route('home.history') }}">
                <select name="status" onchange="this.form.submit()" class="border p-2">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $status=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ $status=='completed' ? 'selected' : '' }}>Completed</option>
                    <option value="refunded" {{ $status=='refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </form>
        </div>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Kode Booking</th>
                    <th class="border px-4 py-2">Item</th>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Durasi</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td class="border px-4 py-2">{{ $booking->booking_code }}</td>
                        <td class="border px-4 py-2">{{ $booking->item->name }}</td>
                        <td class="border px-4 py-2">{{ $booking->date }}</td>
                        <td class="border px-4 py-2">{{ $booking->duration }} hari</td>
                        <td class="border px-4 py-2">Rp {{ number_format($booking->total, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 capitalize">{{ $booking->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada riwayat booking</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
