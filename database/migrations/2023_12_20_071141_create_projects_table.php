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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            //description
            $table->string('description')->nullable();
            $table->string('expertise_detail')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('expertise_field_id')->nullable();
            $table->unsignedBigInteger('budgetcode_id')->nullable();

            //dateposted
            $table->timestamp('dateposted')->nullable();

            $table->softDeletes();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('expertise_field_id')->references('id')->on('expertise_fields')->onDelete('cascade');
            $table->foreign('budgetcode_id')->references('id')->on('budget_codes')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
