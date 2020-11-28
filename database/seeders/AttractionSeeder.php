<?php

namespace Database\Seeders;

use App\Models\Attraction;
use Illuminate\Database\Seeder;

class AttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attraction::factory()
                ->times(100)
                ->create();
    }
}
