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
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('court_id')->constrained()->onDelete('cascade');
        $table->date('booking_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->integer('total_price');
        $table->string('proof_of_payment')->nullable(); // <-- WAJIB ADA untuk simpan path foto bukti bayar
        $table->string('status', 20)->default('pending'); // <-- Diubah default jadi pending
        $table->timestamps();
    });
}
};
