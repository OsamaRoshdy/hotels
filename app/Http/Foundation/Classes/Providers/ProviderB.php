<?php

namespace App\Http\Foundation\Classes\Providers;

use App\Http\Foundation\Providers;

class ProviderB extends Providers
{
    protected string $base_url = 'http://www.mocky.io/v2/5e4010ad3300004200b04d15';

    protected function http_build_query(): array
    {
        return [
            'from_date' => $this->request->from,
            'to_date' => $this->request->to,
            'city_code' => $this->request->city,
            'no_adults' => $this->request->adults,
        ];
    }

    protected function hotelName(): string
    {
        return $this->data->hotelName;
    }

    protected function rate(): int
    {
        return strlen($this->data->Rate);
    }

    protected function price(): int
    {
        return $this->data->Price;
    }

    protected function discount(): int
    {
        return $this->data->discount ?? 0;
    }

    protected function roomAmenities(): string
    {
        return implode(', ',$this->data->amenities) ;
    }
}
