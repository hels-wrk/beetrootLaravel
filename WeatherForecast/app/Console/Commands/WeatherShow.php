<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Weather;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherShow extends Command
{
    private const DEFAULT_PRECISION = 1;


    protected $signature = 'weather_show';

    protected $description = 'Fetch the weather for particular city.';

    public function handle(): void
    {

        $this->output->table(
            ['id', 'city', 'Temperature, °C', 'Humidity, %', 'Pressure, mm Hg', 'Wind, m/s', 'Updated_at'],
            $this->getWeatherDetails()
        );
    }

    private function getWeatherDetails(): array
    {
        $dataByCities = Weather::all()->toArray();

        return $dataByCities;
    }

}
