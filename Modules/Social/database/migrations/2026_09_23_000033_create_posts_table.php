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
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
                $table->text('content')->nullable();
                $table->string('post_type')->default('standard'); // standard, announcement, poll, hyperlocal_notice
                $table->string('visibility')->default('public');  // public, friends_only, private
                $table->string('ward_code')->nullable();          // Hyperlocal Ward tag
                $table->string('thana_code')->nullable();
                $table->string('district_code')->nullable();
                $table->unsignedInteger('likes_count')->default(0);
                $table->unsignedInteger('comments_count')->default(0);
                $table->unsignedInteger('shares_count')->default(0);
                $table->boolean('is_pinned')->default(false);
                $table->timestamps();

                // Indexes for high-concurrency feeds and keyset/cursor pagination
                $table->index(['user_id', 'created_at']);
                $table->index(['created_at', 'id']);
                $table->index(['ward_code', 'created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
