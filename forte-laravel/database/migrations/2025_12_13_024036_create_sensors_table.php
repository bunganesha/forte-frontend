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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->float('latitude')->nullable();;
            $table->float('longitude')->nullable();;
            $table->float('daya')->nullable();;
            $table->float('accelx')->nullable();;
            $table->float('accely')->nullable();;
            $table->float('accelz')->nullable();;
            $table->string('zone')->nullable();;
            $table->string('anomaly')->nullable();;
            $table->string('description')->nullable();;
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
