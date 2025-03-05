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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('caption')->nullable();
            $table->text('content');
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->json('views')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('expiration');
            $table->json('reactions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
