<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type')->default('general')->after('email');
            $table->string('phone')->nullable()->after('user_type');
            $table->string('avatar')->nullable()->after('phone');
            $table->boolean('nid_verified')->default(false)->after('avatar');
            $table->boolean('school_id_verified')->default(false)->after('nid_verified');
            $table->string('provider')->nullable()->after('google_id');
            $table->string('provider_id')->nullable()->after('provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type',
                'phone',
                'avatar',
                'nid_verified',
                'school_id_verified',
                'provider',
                'provider_id'
            ]);
        });
    }
};
