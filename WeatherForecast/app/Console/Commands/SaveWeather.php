<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Weather;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class SaveWeather extends Command
{
    const DEFAULT_PRECISION = 1;

    protected $signature = 'save_weather';

    protected $description = 'Command description';

    public function getWeather():void
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
            var_export($decodedResponse);

            DB::table('weather')->insert([
                'city'=>$city,
                'temperature' => $decodedResponse['main']['temp'],
                'humidity' => $decodedResponse['main']['humidity'],
                'pressure' => $decodedResponse['main']['pressure'],
                'wind_speed' => $decodedResponse['wind']['speed'],
            ]);
        }
    }
    public function handle()
    {
        $this->getWeather();

        var_export(Weather::all()->toArray());
        echo 'Weather saved';
    }
}
