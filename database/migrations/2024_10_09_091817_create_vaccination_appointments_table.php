<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccination_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('vaccination_center_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('appointment_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_appointments');
    }
};
