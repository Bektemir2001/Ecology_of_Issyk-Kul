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
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->text('TLI_formula')->nullable();
            $table->text('TSI_formula')->nullable();
            $table->float('pdk_up')->nullable();
            $table->float('pdk_dawn')->nullable();
            $table->timestamps();

            $table->index('parent', 'element_parent_idx');
            $table->foreign('parent', 'element_parent_fk')
                ->on('elements')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements');
    }
};
