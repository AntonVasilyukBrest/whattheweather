<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getForecast(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
        ]);

        $city = $request->input('city');
        $city_coords = $this->getCoords($city);

        if($city_coords) {
            $forecast = Http::get('https://api.openweathermap.org/data/2.5/onecall?units=metric&lat=' . $city_coords['lat'] . '&lon=' . $city_coords['lon'] . '&appid=' . env('OPENWEATHERMAP_API_KEY'));
        }

        return $forecast ? view('forecast', ['forecast' => $forecast->json(), 'city' => ucfirst($city)]) : view('forecast', ['error' => 'City not found']);
    }

    public function getCoords($city, $country = null, $state = null){
        $query = $city . $country ?? ',' . $country . $state ?? ',' . $state;
        $coords = Http::get("http://api.openweathermap.org/geo/1.0/direct?q=$query&limit=1&appid=".env('OPENWEATHERMAP_API_KEY'));
        if ($coords) {
            return ['lat' => $coords->json()[0]['lat'], 'lon' => $coords->json()[0]['lon']];
        } else {
            return false;
        }
    }

}
