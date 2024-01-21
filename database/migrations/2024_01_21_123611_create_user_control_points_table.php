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
        Schema::create('user_control_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('control_point_id');
            $table->timestamps();

            $table->index('user_id', 'control_point_user_idx');
            $table->index('control_point_id', 'control_point_control_point_idx');


            $table->foreign('user_id', 'control_point_user_fk')
                ->on('users')
                ->references('id');

            $table->foreign('control_point_id', 'control_point_control_point_fk')
                ->on('control_points')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_control_points');
    }
};
