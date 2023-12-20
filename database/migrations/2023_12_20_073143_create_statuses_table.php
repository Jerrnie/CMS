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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            //project id
            $table->unsignedBigInteger('project_id');
            //status name
            $table->string('name')->nullable();
            //status code
            // add comment 1 = draft 2 = posted 3 = completed 4 = cancelled 5 = deleted
            $table->integer('code')->comment('1 = draft 2 = posted 3 = completed 4 = cancelled 5 = deleted')->nullable();

            //soft delete
            $table->softDeletes();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
