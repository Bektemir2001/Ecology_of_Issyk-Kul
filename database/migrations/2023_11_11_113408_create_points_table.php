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
            $table->string('name')->nullable();
            $table->string('name_ru')->nullable();
            $table->integer('distance')->nullable();
            $table->integer('depth')->nullable();
            $table->date('date')->nullable();
            $table->string('X_coordinate')->nullable();
            $table->string('Y_coordinate')->nullable();
            $table->timestamps();


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
