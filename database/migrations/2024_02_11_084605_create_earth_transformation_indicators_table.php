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
        Schema::create('earth_transformation_indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id');
            $table->float('from_the_coast');
            $table->float('area');
            $table->date('date');
            $table->unsignedBigInteger('created_by')->nullable();

            $table->index('district_id');
            $table->foreign('district_id')
                ->on('districts')
                ->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earth_transformation_indicators');
    }
};
