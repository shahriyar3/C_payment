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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('user_name');
            $table->text('token');
            $table->text('decrypted_data');
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('payment_id')->index()->unique();
            $table->string('transaction_id')->nullable()->index();
            $table->enum('status', ['failed', 'success', 'pending'])->default('pending')->index();
            $table->string('user_ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
