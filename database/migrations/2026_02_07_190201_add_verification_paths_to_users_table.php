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
            $table->string('nid_card_path')->nullable()->after('nid_verified');
            $table->string('school_id_path')->nullable()->after('school_id_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('main')->table('users', function (Blueprint $table) {
            $table->dropColumn(['nid_card_path', 'school_id_path']);
        });
    }
};
