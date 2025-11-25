<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, extract the year from existing date values
        DB::statement("UPDATE advocates SET duration_of_practice = YEAR(duration_of_practice) WHERE duration_of_practice IS NOT NULL");
        
        // Then change the column type from date to smallInteger (year)
        Schema::table('advocates', function (Blueprint $table) {
            $table->smallInteger('duration_of_practice')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advocates', function (Blueprint $table) {
            $table->date('duration_of_practice')->nullable()->change();
        });
    }
};
