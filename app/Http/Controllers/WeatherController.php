<?php

namespace App\Http\Controllers;

use App\Weather;

class WeatherController extends Controller
{
    //
    /**
     * @param Weather $weather
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Weather $weather)
    {
        // 53.243325, 34.363731
        return view('weather.index', [
            'pageTitle' => 'Температура в Брянске',
            'temperature' => $weather->getTemperature(),
        ]);
    }
}
