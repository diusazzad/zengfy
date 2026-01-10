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
        Schema::create('case_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('office_file_number')->unique();
            $table->string('court_case_number')->unique();
            $table->string('case_title');
            $table->foreignId('case_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('case_stage_id')->constrained()->onDelete('restrict');
            $table->foreignId('court_id')->constrained()->onDelete('restrict');
            $table->date('opening_date')->nullable();
            $table->date('previous_date')->nullable();
            $table->date('next_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('client_name');
            $table->string('opponent_name');
            $table->string('opponent_lawyer')->nullable();
            $table->decimal('case_fee', 10, 2);
            $table->string('status')->default('pending'); // Add status column
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_models');
    }
};
