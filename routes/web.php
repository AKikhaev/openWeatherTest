<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('apiTest');
});

Route::middleware('cache.headers:public;max_age=600000;etag')->group(function(){
    # http://devtest.test/api/weather/1.0/krasnodar
    Route::get('/api/1.0/weather/{city}', 'OpenWeatherController@get');

//    Route::get('/api/weather/1.0/{city}/get', function ($city) {
//        $key = '77e3ba8317dd91a7eef9b8cf9f632b46';
//
//        $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$key";
//
//        $data = file_get_contents($url);
//
//        return $data;
//
//        return response()->json([
//            'city'=>$city,
//            'temperature'=>28
//        ]);
//
//        return json_encode([
//            'city'=>$city,
//            'temperature'=>28
//        ]);
//    });

});


