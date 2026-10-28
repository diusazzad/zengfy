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
        if (!Schema::hasTable('account_security_logs')) {
            Schema::create('account_security_logs', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id')->index();
                $table->string('event_type', 60); // login, password_change, 2fa_toggle, device_revoke, profile_update
                $table->string('ip_address', 45)->nullable();
                $table->string('device_name', 150)->nullable();
                $table->string('location', 100)->nullable();
                $table->string('status', 30)->default('success'); // success, warning, failed
                $table->json('details')->nullable();
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->index(['user_id', 'created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_security_logs');
    }
};
