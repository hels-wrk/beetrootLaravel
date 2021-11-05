<?php

namespace Database\Seeders;

use App\Services\Weather\GetterWeather;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitiesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    static $cities = [
        'Berlin',
        'Budapest',
        'Cincinnati',
        'Denver',
        'Helsinki',
    ];


    public function run()
    {
        foreach (self::$cities as $city) {
            DB::table('cities')->insert([
                'city' => $city,
            ]);
        }


    }

}
