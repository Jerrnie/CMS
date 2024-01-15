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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('requestor_id')->nullable();
            $table->unsignedBigInteger('consultant_id')->nullable(); // Corrected here

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('requestor_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');

            $table->foreign('consultant_id') // And here
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //soft delete


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
