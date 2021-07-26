<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Weather
{
    public const HEADER_API_KEY = 'X-Yandex-API-Key';
    public const CACHE_LIFE_TIME_IN_MINUTES = '60';
    public const CACHE_KEY = 'weather';

    public function load() : string
    {
        if (!Cache::has(self::CACHE_KEY)) {
            $responseBody = Http::withHeaders([self::HEADER_API_KEY => $this->getApiKey()])->get($this->getApiUrl())->body();
            Cache::add(
                self::CACHE_KEY,
                $responseBody,
                Carbon::now()->addMinutes(self::CACHE_LIFE_TIME_IN_MINUTES)
            );
        } else {
            $responseBody = Cache::get(self::CACHE_KEY);
        }

        return $responseBody;
    }

    private function getApiKey() : string
    {
        return \config('services.yandex_weather_api.key') ?? '';
    }

    private function getApiUrl() : string
    {
        return \config('services.yandex_weather_api.url') ?? '';
    }
}
