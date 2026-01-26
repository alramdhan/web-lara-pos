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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trx_invoice')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->decimal('total_belanja', 12, 2);
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed', 'canceled', 'unpaid'])->default('unpaid');
            $table->enum('metode_pembayaran', ['cash', 'qris', 'transfer'])->default('cash');
            $table->decimal('pay_amount', 12, 2);
            $table->decimal('change_amount', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
