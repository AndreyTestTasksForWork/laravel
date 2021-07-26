<?php

namespace App\Http\Controllers;

use App\Weather;

class WeatherController extends Controller
{
    public function get()
    {
        return (new Weather())->load();
    }
}
