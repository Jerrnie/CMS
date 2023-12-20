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
        Schema::create('trenches', function (Blueprint $table) {
            $table->id();
            $table->unasignedBigInteger('project_id');
            //from date
            $table->date('from_date')->nullable();
            //to date
            $table->date('to_date')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->timestamps();

            //soft delete
            $table->softDeletes();



            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trenches');
    }
};
