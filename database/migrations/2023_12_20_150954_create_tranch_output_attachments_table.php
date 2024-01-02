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
        Schema::create('tranch_output_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('tranch_output_id');
            $table->text('description')->nullable();
            $table->tinyInteger('type')->default(1); // 1 = file, 2 = url
            $table->text('file_name')->nullable();
            $table->text('original_file_name')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();

            $table->foreign('tranch_output_id')->references('id')->on('tranch_outputs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranch_output_attachments');
    }
};
