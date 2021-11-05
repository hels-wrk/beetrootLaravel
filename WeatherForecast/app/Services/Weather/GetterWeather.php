<?php
namespace App\Services\Weather;


use App\Models\city;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;


class GetterWeather
{
    private const DEFAULT_PRECISION = 1;

    public function getWeatherDetails(): array
    {
        $dataByCities = [];
        foreach (City::all() as $city) {
            $city = $city->city;
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
