<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_group', function (Blueprint $table) {
            $table->foreignId('store_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreignId('group_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->primary(['store_id','group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_group');
    }
};
