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
            $table->string('username')->nullable()->after('name');
            $table->date('birthday')->nullable()->after('username');
            $table->string('icon_path')->nullable()->after('birthday');
            $table->text('bio')->nullable()->after('icon_path');
            $table->string('birthplace')->nullable()->after('bio');
            $table->string('phone_number')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'birthday',
                'icon_path',
                'bio',
                'birthplace',
                'phone_number',
            ]);
        });
    }
};
