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
            if (! Schema::hasColumn('users', 'nid_number')) {
                $table->text('nid_number')->nullable()->after('nid_verified');
            }
            if (! Schema::hasColumn('users', 'nid_hash')) {
                $table->string('nid_hash', 64)->nullable()->unique()->after('nid_number');
            }
            if (! Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('nid_hash');
            }
            if (! Schema::hasColumn('users', 'nid_verified_at')) {
                $table->timestamp('nid_verified_at')->nullable()->after('date_of_birth');
            }
            if (! Schema::hasColumn('users', 'verified_badge')) {
                $table->boolean('verified_badge')->default(false)->after('nid_verified_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            foreach (['nid_number', 'nid_hash', 'date_of_birth', 'nid_verified_at', 'verified_badge'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $columns[] = $col;
                }
            }
            if (! empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
