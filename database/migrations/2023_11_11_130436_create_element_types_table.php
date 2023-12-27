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
        Schema::create('element_types', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('element_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index('element_id', 'element_type_element_idx');
            $table->foreign('element_id', 'element_type_element_fk')
                ->on('elements')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_types');
    }
};
