<?php

namespace App\Http\Foundation\Classes;

use App\Http\Foundation\Classes\Providers\ProviderA;
use App\Http\Foundation\Classes\Providers\ProviderB;

class Hotels
{
    public static function getHotels($request)
    {
        $hotels = self::providersHotels($request);
        return self::sortHotelsByRateing($hotels);
    }

    private static function providersHotels($request)
    {
        $providerA = new ProviderA($request);
        $providerB = new ProviderB($request);
        return array_merge($providerA->getHotels(), $providerB->getHotels());
    }

    private static function sortHotelsByRateing($hotels)
    {
        $data = collect($hotels)->sortByDesc('rate');
        return $data->values()->all();
    }
}
