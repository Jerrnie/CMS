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
        Schema::create('budget_codes', function (Blueprint $table) {
            $table->id();
            $table->string('unit_activity');
            $table->decimal('budget', 10, 2);
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('quarter_id');
            $table->unsignedBigInteger('year_id');
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('quarter_id')->references('id')->on('quarters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
