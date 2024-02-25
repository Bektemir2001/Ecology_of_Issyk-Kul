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
        Schema::create('trophic_state_index_for_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_index_id');
            $table->unsignedBigInteger('element_id');
            $table->float('from');
            $table->float('to')->nullable();

            $table->index('t_index_id');
            $table->index('element_id');

            $table->foreign('t_index_id')
                ->on('trophic_state_indices')
                ->references('id');
            $table->foreign('element_id')
                ->on('elements')
                ->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trophic_state_index_for_elements');
    }
};
