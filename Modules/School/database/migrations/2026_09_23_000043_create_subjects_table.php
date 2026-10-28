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
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignUuid('class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->string('name'); // e.g. "General Mathematics"
            $table->string('code')->nullable(); // e.g. "MATH-101"
            $table->string('type')->default('core'); // core, elective, optional
            $table->decimal('credits', 4, 2)->default(3.00);
            $table->integer('pass_marks')->default(33);
            $table->integer('total_marks')->default(100);
            $table->timestamps();

            $table->index(['organization_id', 'class_id']);
            $table->index(['organization_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
