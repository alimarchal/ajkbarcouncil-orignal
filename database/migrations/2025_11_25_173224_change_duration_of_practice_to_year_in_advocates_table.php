<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Note: This migration converts date values to year integers.
     * This is a one-way data transformation - month and day data will be lost.
     */
    public function up(): void
    {
        // First, extract the year from existing date values using query builder
        DB::table('advocates')
            ->whereNotNull('duration_of_practice')
            ->update(['duration_of_practice' => DB::raw('YEAR(duration_of_practice)')]);
        
        // Then change the column type from date to smallInteger (year)
        Schema::table('advocates', function (Blueprint $table) {
            $table->smallInteger('duration_of_practice')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Warning: This reversal only changes the column type back to date.
     * The original month/day data cannot be restored as it was lost during
     * the up() migration. Year values will be converted to dates as YYYY-01-01.
     */
    public function down(): void
    {
        // Convert year integers back to date format (using January 1st as default)
        DB::table('advocates')
            ->whereNotNull('duration_of_practice')
            ->update(['duration_of_practice' => DB::raw("CONCAT(duration_of_practice, '-01-01')")]);
        
        Schema::table('advocates', function (Blueprint $table) {
            $table->date('duration_of_practice')->nullable()->change();
        });
    }
};
