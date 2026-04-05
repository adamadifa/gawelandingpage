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
        Schema::table('membership_subscriptions', function (Blueprint $table) {
            $table->string('app_url')->nullable()->after('status');
            $table->enum('app_status', ['pending', 'running', 'maintenance'])->default('pending')->after('app_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['app_url', 'app_status']);
        });
    }
};
