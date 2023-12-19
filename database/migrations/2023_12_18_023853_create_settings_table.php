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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            //logo
            $table->string('logo')->nullable();
            //homepage Banner
            $table->string('HomePageBanner')->nullable();
            //opportunities Banner
            $table->string('opportunitiesBanner')->nullable();
            //applications Banner
            $table->string('applicationsBanner')->nullable();
            //projects Banner
            $table->string('projectsBanner')->nullable();
            //about us
            $table->string('aboutUsBanner')->nullable();
            //opportunities Banner
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
