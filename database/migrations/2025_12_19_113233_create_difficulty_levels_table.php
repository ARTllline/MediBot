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
        Schema::create('difficulty_levels', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->unsignedBigInteger('weight')->default(0);
            $table->timestamps();
        });

        Schema::table('meditations', function (Blueprint $table) {
            $table->unsignedBigInteger('difficulty_level_id')->nullable();
            $table->foreign('difficulty_level_id')->references('id')->on('difficulty_levels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulty_levels');
    }
};
