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
        Schema::create('organic_substances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('name_ky')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->float('pdk_up')->nullable();
            $table->float('pdk_dawn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organic_substances');
    }
};
