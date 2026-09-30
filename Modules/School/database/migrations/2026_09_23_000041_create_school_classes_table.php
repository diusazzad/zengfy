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
        Schema::create('school_classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignUuid('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->string('name'); // e.g. "Class 10", "Grade 6"
            $table->integer('numeric_grade')->nullable(); // e.g. 10, 6
            $table->string('code')->nullable(); // e.g. "CLS-10"
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['organization_id', 'academic_year_id']);
            $table->unique(['organization_id', 'academic_year_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};
