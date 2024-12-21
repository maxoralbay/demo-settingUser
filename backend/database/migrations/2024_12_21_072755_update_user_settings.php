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
        // change name key to key1 and key2
        Schema::table('user_settings', function (Blueprint $table) {
            $table->renameColumn('settings_key', 'key1');
            $table->renameColumn('settings_value', 'key2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
