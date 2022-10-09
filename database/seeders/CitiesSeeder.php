<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities=file_get_contents(PUBLIC_PATH().'/cities.json');
        $cities=json_decode($cities);
        foreach($cities as $city){
            City::create(['name'=>$city->name,'position'=>$city->position]);
        }
    }
}
