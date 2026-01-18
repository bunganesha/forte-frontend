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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('credit_score')->default(100)->after('password');
            $table->text('credit_history')->nullable()->after('credit_score');
        });

        Schema::create('credit_score_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('previous_score');
            $table->integer('new_score');
            $table->integer('change_amount');
            $table->string('reason');
            $table->string('action_type'); // 'report', 'verification', 'rejection', 'compliance', etc
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['credit_score', 'credit_history']);
        });

        Schema::dropIfExists('credit_score_logs');
    }
};
