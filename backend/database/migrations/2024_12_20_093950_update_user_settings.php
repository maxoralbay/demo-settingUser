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
        //
        // add nullable to key and value
        Schema::table('user_settings', function (Blueprint $table) {
            $table->string('key')->nullable()->change();
            $table->string('value')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('user_settings', function (Blueprint $table) {
            $table->string('key')->change();
            $table->string('value')->change();
        });
    }
};
