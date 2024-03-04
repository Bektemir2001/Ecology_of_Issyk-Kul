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
        Schema::create('element_formulas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id');
            $table->unsignedBigInteger('formula_id');
            $table->timestamps();

            $table->index('element_id');
            $table->index('formula_id');

            $table->foreign('element_id')
                ->on('elements')
                ->references('id')
                ->cascadeOnDelete();
            $table->foreign('formula_id')
                ->on('formulas')
                ->references('id')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_formulas');
    }
};
