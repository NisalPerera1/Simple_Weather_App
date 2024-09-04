<?php

use Illuminate\Support\Facades\Route;



Route::get('/',  [App\Http\Controllers\WeatherController::class, 'index'])->name('weather.index');
Route::post('/weather',  [App\Http\Controllers\WeatherController::class, 'getWeather'])->name('get.weather');
