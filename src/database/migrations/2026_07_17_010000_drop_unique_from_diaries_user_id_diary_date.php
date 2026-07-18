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
        Schema::table('diaries', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('diaries', function (Blueprint $table) {
            $table->dropUnique('diaries_user_id_diary_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->unique(['user_id', 'diary_date']);
            $table->dropIndex(['user_id']);
        });
    }
};
