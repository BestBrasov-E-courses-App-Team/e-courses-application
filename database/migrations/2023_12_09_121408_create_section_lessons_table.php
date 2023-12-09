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
        Schema::create('section_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_section_id');
            $table->unsignedBigInteger('course_id');
            $table->mediumText('title');
            $table->longText('description')->nullable();
            $table->mediumText('media_path')->nullable();
            $table->mediumText('media_type')->nullable();
            $table->mediumText('media_extension')->nullable();
            $table->json('misc')->nullable();
            $table->boolean('public')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_lessons');
    }
};
