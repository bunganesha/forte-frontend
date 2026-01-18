<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'credit_score')) {
                $table->integer('credit_score')->default(100)->after('password');
            }

            if (!Schema::hasColumn('users', 'credit_history')) {
                $table->text('credit_history')->nullable()->after('credit_score');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'credit_history')) {
                $table->dropColumn('credit_history');
            }

            if (Schema::hasColumn('users', 'credit_score')) {
                $table->dropColumn('credit_score');
            }
        });
    }
};
