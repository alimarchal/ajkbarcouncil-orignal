<?php

namespace Database\Seeders;

use App\Models\Advocate;
use Illuminate\Database\Seeder;

class AdvocateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advocate::factory()->count(50)->create();
    }
}