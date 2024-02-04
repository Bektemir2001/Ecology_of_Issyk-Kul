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
        Schema::create('point_organic_substances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('point_id');
            $table->unsignedBigInteger('organic_substance_id');
            $table->float('item');

            $table->index('point_id', 'point_organic_substances_point_idx');
            $table->index('organic_substance_id', 'point_organic_substances_organic_substance_idx');

            $table->foreign('point_id', 'point_organic_substances_point_fk')
                ->on('points')
                ->references('id');
            $table->foreign('organic_substance_id', 'point_organic_substances_organic_substance_fk')
                ->on('organic_substances')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_organic_substances');
    }
};
