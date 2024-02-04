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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('control_point_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('name_ky')->nullable();
            $table->float('distance_from_starting_point');
            $table->string('depth');
            $table->date('date');
            $table->float('depth_item');
            $table->float('temperature');
            $table->float('transparency');
            $table->float('hardness');
            $table->float('electrical_conductivity');
            $table->float('pH');
            $table->float('oxygen_mg');
            $table->float('oxygen_saturation');
            $table->string('X_coordinate')->nullable();
            $table->string('Y_coordinate')->nullable();
            $table->timestamps();
            $table->index('control_point_id', 'point_control_point_idx');
            $table->index('user_id', 'user_point_idx');

            $table->foreign('control_point_id', 'point_control_point_fk')
                ->on('control_points')
                ->references('id');
            $table->foreign('user_id', 'user_point_fk')
                ->on('users')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
