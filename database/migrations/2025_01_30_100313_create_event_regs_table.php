<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_regs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->string('tshirt_size')->nullable();
            $table->enum('attendance', ['present', 'absent', 'not_decided'])->nullable()->default('present');
            $table->boolean('consent')->default(true);
            $table->enum('guest_status', ['has_guest', 'no_guest'])->default('no_guest');
            $table->integer('adult_guest_count')->default(0);
            $table->integer('child_guest_count')->default(0);
            $table->integer('guest_fee')->default(0);
            $table->enum('payment_method', ['bkashpay', 'bankpay', 'cashpay']);
            $table->integer('reg_fee');
            $table->string('trx_id')->nullable()->unique();
            $table->string('ref_id')->nullable();
            $table->string('trx_id_bkash')->nullable(); // Store bKash transaction ID
            $table->enum('verified', ['paymentverified', 'invalid', 'notyet'])->default('notyet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_regs');
    }
};
