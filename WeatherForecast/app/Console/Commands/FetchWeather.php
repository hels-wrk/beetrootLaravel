<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class FetchWeather extends Command
{
    private const DEFAULT_PRECISION = 1;


    protected $signature = 'weather {cities*}';


    protected $description = 'Fetch the weather for particular city.';

    public function handle(): void
    {
        $this->output->table(
            ['City', 'Temperature, °C', 'Humidity, %', 'Pressure, mm Hg', 'Wind, m/s'],
            $this->getWeatherDetails()
        );
    }

    private function getWeatherDetails(): array
    {
        $dataByCities = [];
        foreach ($this->argument('cities') as $city) {
            $url = sprintf(
                'api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=metric',
                $city,
                config('app.openweathermap_app_id')
            );
            $response = Http::get($url);
            if ($response->status() !== Response::HTTP_OK) {
                throw new Exception("Invalid response: {$response->body()}");
            }

            $decodedResponse = json_decode($response->body(), true);
            $dataByCities[] = compact('city') + $this->normalizeWeatherDetails($decodedResponse);
        }

        return $dataByCities;
    }

    private function normalizeWeatherDetails(array $weatherData): array
    {
        return [
            'temperature' => (int) $weatherData['main']['temp'],
            'humidity' => (int) $weatherData['main']['humidity'],
            'pressure' => (int) $weatherData['main']['pressure'],
            'wind' => round($weatherData['wind']['speed'], self::DEFAULT_PRECISION),
        ];
    }
}
