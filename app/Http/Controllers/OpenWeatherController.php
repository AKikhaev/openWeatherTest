<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use function GuzzleHttp\Psr7\build_query;
#use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Cache;

/**
 * Class OpenWeatherController
 *
 * produce cached protected query forward to open weather api
 *
 * @package App\Http\Controllers
 */
class OpenWeatherController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param string $city
     * @return string
     */
    public function get(Request $request,$city)
    {
        $key = $request->getUri();
        $status = 200;
        if (Cache::has($key)){
            $json = Cache::get($key);
        } else {
            $response = Http::timeout(5)->get('https://api.openweathermap.org/data/2.5/weather',[
                'q'=>$city,
                'appid'=>env('OPEN_WEATHER_KEY')
            ]);
            $json = $response->json();
            $status = $response->status();
            if ($status===200) {
                Cache::put('key', $json, env('OPEN_WEATHER_CACHE_MIN'));
            }
        };

        //$json = '{"coord":{"lon":73.4,"lat":55},"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01n"}],"base":"stations","main":{"temp":281.15,"feels_like":278.05,"temp_min":281.15,"temp_max":281.15,"pressure":1024,"humidity":65},"visibility":10000,"wind":{"speed":2,"deg":220},"clouds":{"all":0},"dt":1588805034,"sys":{"type":1,"id":8960,"country":"RU","sunrise":1588806804,"sunset":1588863148},"timezone":21600,"id":1496153,"name":"Omsk","cod":200}';

        return response()->json($json,$status);
    }
}