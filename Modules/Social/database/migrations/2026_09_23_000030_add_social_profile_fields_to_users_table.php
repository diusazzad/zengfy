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
        Schema::table('users', function (Blueprint $table) {
            $table->string('handle')->nullable()->unique()->after('name');
            $table->text('bio')->nullable()->after('handle');
            $table->string('ward_code')->nullable()->index()->after('city');
            $table->string('thana_code')->nullable()->index()->after('ward_code');
            $table->string('district_code')->nullable()->index()->after('thana_code');
            $table->unsignedInteger('followers_count')->default(0)->after('district_code');
            $table->unsignedInteger('following_count')->default(0)->after('followers_count');
            $table->unsignedInteger('friends_count')->default(0)->after('following_count');
            $table->boolean('is_private')->default(false)->after('friends_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'handle',
                'bio',
                'ward_code',
                'thana_code',
                'district_code',
                'followers_count',
                'following_count',
                'friends_count',
                'is_private',
            ]);
        });
    }
};
