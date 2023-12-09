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
        Schema::create('consultant_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('years_experience')->nullable();
            $table->string('consulting_category')->nullable();
            $table->enum('relatives_at_zff', ['yes', 'no'])->nullable();
            $table->string('zff_staff_relative_name')->nullable();
            $table->enum('zff_staff_partner', [0, 1, 2])->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_position_title')->nullable();
            $table->string('partner_employee_number')->nullable();
            $table->enum('zff_staff', ['yes', 'no'])->nullable();
            $table->string('position_title')->nullable();
            $table->string('employee_number')->nullable();
            $table->date('employment_end_date')->nullable();
            $table->date('gov_employment_end_date')->nullable();
            $table->enum('director_or_above', ['yes', 'no'])->nullable();
            $table->enum('government_employee', ['yes', 'no'])->nullable();
            $table->string('agency_name')->nullable();
            $table->string('country')->nullable();
            $table->enum('consulting_assignment_at_zff', ['yes', 'no'])->nullable();
            $table->enum('found_guilty', ['yes', 'no'])->nullable();
            $table->string('guiltyDetails')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_info');
    }
};
