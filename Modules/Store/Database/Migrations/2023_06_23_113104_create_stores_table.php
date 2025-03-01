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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_accepted')->default(false);
            $table->timestamp('ban_at')->nullable();
            $table->string('block_reason')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            // $table->float('rating')->default(0);
            // $table->enum('level', [1, 2, 3, 4, 5])->default(1);
            $table->foreignId('seller_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
