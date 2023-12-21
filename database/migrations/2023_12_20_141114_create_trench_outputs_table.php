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
        Schema::create('trench_outputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trench_id');
            $table->unsignedBigInteger('consultant_id');
            //date sumbitted
            $table->date('date_submitted')->nullable();
            //date approved
            $table->date('date_approved')->nullable();
            //date rejected
            $table->date('date_rejected')->nullable();
            //comment
            $table->string('comment')->nullable();


            $table->foreign('trench_id')
                ->references('id')
                ->on('trenches')
                ->onDelete('cascade');

            $table->foreign('consultant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //soft delete
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trench_outputs');
    }
};