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
        Schema::create('jobs_ads', function (Blueprint $table) {
            $table->id();
            $table->morphs('userable');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location');
            $table->decimal('salary', 8, 2)->nullable();
            $table->string('company');
            $table->enum('type', ['full-time', 'part-time', 'piece'])->default('full-time');
            $table->enum('place', ['office', 'remotly'])->default('office');
            $table->date('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
