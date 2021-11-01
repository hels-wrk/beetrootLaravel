<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class FetchWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $city = $this->argument('city');
        $key = '23714fafb632e1ad8b618eed2b153f1b';
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$key}");
        return var_export(json_decode($response));
    }
}
