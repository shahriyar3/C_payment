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
        Schema::table('payments', function (Blueprint $table) {
            DB::statement("ALTER TABLE `payments` CHANGE `payment_type` `payment_type` ENUM('IRGATE','KENZO','VODA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KENZO'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            DB::statement("ALTER TABLE `payments` CHANGE `payment_type` `payment_type` ENUM('IRGATE','KENZO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KENZO'");
        });
    }
};
