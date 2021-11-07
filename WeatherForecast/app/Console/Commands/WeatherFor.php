<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Console\Command;

class WeatherFor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:for{city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle()
    {
        $this->output->table(
            ['id', 'City_id', 'Temperature, °C', 'Humidity, %', 'Pressure, mm Hg', 'Wind, m/s', 'Updated_at'],
            $this->getWeatherDetails()
        );
    }

    private function getWeatherDetails(): array
    {
        $cityArgument = $this->argument('city');

        foreach (City::all() as $city){
            if($city->city == $cityArgument){
                $findId = $city->id;
                break;
            }
        }

        foreach (Weather::all() as $item) {

            if($item->city_id == $findId) {
                $dataByCities = $item;
                break;
            }
        }

    }
}
