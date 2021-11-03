<?php

use Illuminate\Support\Facades\Http;

$apiKey = '23714fafb632e1ad8b618eed2b153f1b';
$city = $_GET['city'] ?? 'Kyiv';

$url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&lang=ru&units=metric&appid=' . $apiKey;
$response = Http::get($url);

$data = json_decode($response);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather in Kyiv</title>
</head>
<body>
<div class="weather">
    <form action="#" method="GET">
        <select name='city'>
            <option value="Kyiv">Kyiv</option>
            <option value="Moscow">Moscow</option>
            <option value="Chernihiv">Chernihiv</option>
        </select>
        <div><input type="submit" value="Show weather"></div>
    </form>
</div>
<h2>Погода в городе <?php echo $data->name; ?></h2>
<p>Погода: <?php echo $data->main->temp_min; ?>°C</p>
<p>Влажность: <?php echo $data->main->humidity; ?> %</p>
<p>Ветер: <?php echo $data->wind->speed; ?> км/ч</p>
</body>
</html>



