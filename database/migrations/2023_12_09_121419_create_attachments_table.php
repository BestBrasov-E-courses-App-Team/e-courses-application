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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('owner_type')->nullable();
            $table->string('owner_class');
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->string('type');
            $table->string('mime_type')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('attachments');
    }
};
