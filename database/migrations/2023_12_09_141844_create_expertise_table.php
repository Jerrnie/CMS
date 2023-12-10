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
        Schema::create('expertises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('expertise_field_id')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->text('detail')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('expertise_field_id')->references('id')->on('expertise_fields')->onDelete('cascade');

            // Add unique constraint to ensure each user has only one primary expertise
            // $table->unique(['user_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expertise');
    }
};
