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
        Schema::table('control_points', function (Blueprint $table) {
            $table->unsignedBigInteger('district_id');
            $table->index('district_id');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('control_points', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropIndex(['district_id']);
            $table->dropColumn('district_id');
        });
    }
};
