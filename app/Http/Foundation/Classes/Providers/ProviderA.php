<?php

namespace App\Http\Foundation\Classes\Providers;

use App\Http\Foundation\Providers;

class ProviderA extends Providers
{
    protected string $base_url = 'http://www.mocky.io/v2/5e400f423300005500b04d0c';

    protected function http_build_query(): array
    {

        return [
            'dateFrom' => $this->request->from,
            'dateTo' => $this->request->to,
            'city' => $this->request->city,
            'adults' => $this->request->adults,
        ];
    }

    protected function hotelName(): string
    {
        return $this->data->Hotel;
    }

    protected function rate(): int
    {
        return $this->data->Rate;
    }

    protected function price(): int
    {
        return $this->data->Fare;
    }

    protected function discount(): int
    {
        return 0;
    }

    protected function roomAmenities(): string
    {
        return $this->data->roomAmenities;
    }
}
