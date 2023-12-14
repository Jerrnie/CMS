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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Role name');
            $table->string('description')->nullable()->comment('Role description');
            $table->boolean('is_active')->default(true)->comment('Role status');
            // level
            // 1 - super admin
            // 2 - admin + finance
            // 3 - admin

            $table->integer('level')->default(3)->comment('Role level');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
