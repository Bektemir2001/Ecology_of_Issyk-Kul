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
        Schema::create('point_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_id');
            $table->unsignedBigInteger('element_id');
            $table->float('item');
            $table->timestamps();

            $table->index('point_id', 'point_elements_point_idx');
            $table->index('element_id', 'point_elements_element_idx');

            $table->foreign('point_id', 'point_elements_point_fk')
            ->on('points')
            ->references('id');
            $table->foreign('element_id', 'point_elements_element_fk')
            ->on('elements')
            ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_elements');
    }
};
