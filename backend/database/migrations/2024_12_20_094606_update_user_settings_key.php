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
        // change key to settings_key and value to settings_value
        Schema::table('user_settings', function (Blueprint $table) {
            $table->renameColumn('key', 'settings_key');
            $table->renameColumn('value', 'settings_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('user_settings', function (Blueprint $table) {
            $table->renameColumn('settings_key', 'key');
            $table->renameColumn('settings_value', 'value');
        });
    }
};
