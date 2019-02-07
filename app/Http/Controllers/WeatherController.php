<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    const WEATHER_API_URL = '';
    const LIMIT = 1;
    const HOUR = false;
    const LANGUAGE = 'ru';
    const EXTRA = false;

    /*
     * Shows wheather
     * by default Bryansk city's weather
    */

    public function show(){

        $params = [
            'lat' => '53.243562', // Bryansk lattitude
            'lon' => '34.363443', // Braynsk longitude
            'lang' => self::LANGUAGE,
            'limit' => self::LIMIT,
            'hours' => self::HOUR,
            'extra' => self::EXTRA,
        ];

        $header = [
            'X-Yandex-API-Key' => env('YANDEX_APP_KEY'),
            'AccessToken' => csrf_token(),
            ];

        $client  = new Client([
            'headers' => $header
        ]);


        $response = $client->request('GET', 'https://api.weather.yandex.ru/v1/forecast', [
            'verify' => false,
            'query' => $params,
            ]
        );

        $response_body = json_decode($response->getBody());

        return view('weather.show', compact('response_body'));

    }
}
