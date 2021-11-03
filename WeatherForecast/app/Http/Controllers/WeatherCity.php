<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherCity extends Controller
{
    public function index($city)
    {
    $apiKey = '23714fafb632e1ad8b618eed2b153f1b';

    $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city. '&lang=ru&units=metric&appid=' . $apiKey;
    $response = Http::get($url);

    $data = json_decode($response);

    return view('weatherCity')->with(['data'=>$data]);

    }
}
