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
        Schema::create('point_major_ions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('point_id');
            $table->unsignedBigInteger('ion_id');
            $table->float('item');

            $table->index('point_id', 'point_major_ions_point_idx');
            $table->index('ion_id', 'point_major_ions_element_idx');

            $table->foreign('point_id', 'point_major_ions_point_fk')
                ->on('points')
                ->references('id');
            $table->foreign('ion_id', 'point_major_ions_element_fk')
                ->on('major_ions')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_major_ions');
    }
};
