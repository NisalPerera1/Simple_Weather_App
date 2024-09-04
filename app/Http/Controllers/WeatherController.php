<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $date = $request->input('date');

        try {
            $apiKey = '6YMT24E57SCALQDNGNBM34ANH';
            $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/{$city}?unitGroup=metric&key={$apiKey}&contentType=json";
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();

                // Find the forecast for the selected date
                $selectedDayForecast = null;
                foreach ($data['days'] as $day) {
                    if (Carbon::parse($day['datetime'])->isSameDay(Carbon::parse($date))) {
                        $selectedDayForecast = $day;
                        break;
                    }
                }

                if ($selectedDayForecast) {
                    return view('weather.index', [
                        'city' => $city,
                        'date' => $date,
                        'selectedDayForecast' => $selectedDayForecast,
                    ]);
                } else {
                    return view('weather.index', [
                        'city' => $city,
                        'date' => $date,
                        'error' => 'No weather data available for the selected date.',
                    ]);
                }
            } else {
                return view('weather.index', [
                    'city' => $city,
                    'date' => $date,
                    'error' => 'Failed to retrieve weather data.',
                ]);
            }
        } catch (\Exception $e) {
            return view('weather', [
                'city' => $city,
                'date' => $date,
                'error' => 'An error occurred: ' . $e->getMessage(),
            ]);}
    }

}
