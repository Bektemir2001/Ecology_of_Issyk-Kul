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
        Schema::create('control_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('like_id');
            $table->string('number')->nullable();
            $table->string('name');
            $table->string('name_ru')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ru')->nullable();
            $table->string('X_coordinate')->nullable();
            $table->string('Y_coordinate')->nullable();

            $table->timestamps();

            $table->index('like_id', 'point_like_idx');

            $table->foreign('like_id', 'point_like_fk')
                ->on('likes')
                ->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_points');
    }
};
