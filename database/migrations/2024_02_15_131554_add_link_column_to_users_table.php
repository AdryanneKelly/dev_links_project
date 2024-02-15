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
            $table->longText('bio')->nullable()->change();
            $table->string('nickname')->nullable()->change();
            $table->longText('avatar')->nullable()->change();
            $table->string('primary_color')->nullable()->change();
            $table->string('secondary_color')->nullable()->change();
            $table->longText('profile_links')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
