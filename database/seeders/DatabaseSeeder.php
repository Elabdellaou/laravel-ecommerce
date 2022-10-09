<?php

namespace Database\Seeders;

use App\Models\TrailerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CountriesSeeder::class,
            CitiesSeeder::class,
            TrailerTypeSeeder::class,
            TailerSeeder::class,
            DeviseSeeder::class
        ]);
    }
}
