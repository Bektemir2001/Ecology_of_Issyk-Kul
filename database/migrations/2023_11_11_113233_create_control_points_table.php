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
            $table->unsignedBigInteger('lake_id');
            $table->string('number')->nullable();
            $table->string('name');
            $table->string('name_ky')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ky')->nullable();
            $table->string('X_coordinate')->nullable();
            $table->string('Y_coordinate')->nullable();

            $table->timestamps();

            $table->index('lake_id', 'point_lake_idx');

            $table->foreign('lake_id', 'point_lake_fk')
                ->on('lakes')
                ->references('id');
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
