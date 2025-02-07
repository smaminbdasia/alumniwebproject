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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_bangla')->nullable();
            $table->string('slug')->unique();
            $table->enum('type', ['public', 'private'])->default('public');
            $table->date('date');
            $table->integer('reg_fee')->default(0);
            $table->integer('adult_guest_fee')->default(0);
            $table->integer('child_guest_fee')->default(0);
            $table->string('cover_photo')->nullable(); // ✅ Cover photo
            $table->text('description')->nullable(); // ✅ Short description
            $table->enum('event_status', ['active', 'completed', 'announced', 'draft'])->default('active'); // ✅ Event status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
