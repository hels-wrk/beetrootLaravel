<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;

class WeatherShow extends Command
{
    private const DEFAULT_PRECISION = 1;


    protected $signature = 'weather_show';

    protected $description = 'Fetch the weather for particular city.';

    public function handle(): void
    {

        $this->output->table(
            ['id', 'City_id', 'Temperature, °C', 'Humidity, %', 'Pressure, mm Hg', 'Wind, m/s', 'Updated_at'],
            $this->getWeatherDetails()
        );
    }

    private function getWeatherDetails(): array
    {
        $dataByCities = Weather::all()->toArray();

        return $dataByCities;
    }

}
