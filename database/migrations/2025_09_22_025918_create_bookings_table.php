<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('booking_code')->unique();
            $table->string('snap_token')->nullable();
            $table->date('date');
            $table->integer('duration');
            $table->integer('total');
            $table->integer('dp')->nullable();
            $table->integer('fine')->nullable()->comment('denda');
            $table->integer('delay')->nullable()->comment('hari');
            $table->enum('status', [
                'pending',
                'confirmed',
                'canceled',
                'expired',
                'completed',
                'refunded'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
