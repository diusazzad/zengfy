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
        Schema::create('emergency_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('accuracy', 8, 2)->nullable();
            $table->string('ward_code', 50)->nullable()->index();
            $table->string('thana_code', 50)->nullable()->index();
            $table->string('district_code', 50)->nullable();
            $table->string('status', 20)->default('active')->index(); // active, resolved, cancelled, false_alarm
            $table->string('distress_type', 50)->default('general'); // general, medical, harassment, accident, fire
            $table->unsignedTinyInteger('battery_level')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->unsignedInteger('responders_count')->default(0);
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['ward_code', 'status']);
            $table->index(['user_id', 'status']);
        });

        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('contact_name', 100);
            $table->string('contact_phone', 20);
            $table->string('relationship', 50)->nullable();
            $table->boolean('is_trusted')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'is_trusted']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
        Schema::dropIfExists('emergency_events');
    }
};
