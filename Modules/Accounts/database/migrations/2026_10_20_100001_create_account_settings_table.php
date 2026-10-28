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
        if (!Schema::hasTable('account_settings')) {
            Schema::create('account_settings', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id')->unique();
                $table->string('theme', 20)->default('light');
                $table->string('locale', 10)->default('bn');
                $table->boolean('two_factor_enabled')->default(false);
                $table->string('two_factor_method', 30)->default('authenticator');
                $table->text('two_factor_secret')->nullable();
                $table->json('two_factor_recovery_codes')->nullable();
                $table->timestamp('two_factor_confirmed_at')->nullable();
                $table->string('recovery_email')->nullable();
                $table->string('recovery_phone', 30)->nullable();
                $table->boolean('login_alerts')->default(true);
                $table->json('extra_attributes')->nullable(); // Extensible key-value storage for future features
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_settings');
    }
};
