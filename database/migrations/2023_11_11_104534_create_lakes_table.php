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
        Schema::create('lakes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ru')->nullable();
            $table->string('X_coordinate')->nullable();
            $table->string('Y_coordinate')->nullable();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ru')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lakes');
    }
};
