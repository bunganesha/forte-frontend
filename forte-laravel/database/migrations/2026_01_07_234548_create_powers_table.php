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
        Schema::create('powers', function (Blueprint $table) {
            $table->id();

            $table->float('voltage');
            $table->float('current');
            $table->float('power');

            $table->double('energy_wh', 15, 3);
            $table->double('energy_kwh', 15, 6);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('power_readings');
    }
};
