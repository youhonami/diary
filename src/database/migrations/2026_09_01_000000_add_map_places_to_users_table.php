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
            $table->string('home_place')->nullable()->after('toppage_background');
            $table->string('work_place')->nullable()->after('home_place');
            $table->string('favorite_place')->nullable()->after('work_place');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['home_place', 'work_place', 'favorite_place']);
        });
    }
};
