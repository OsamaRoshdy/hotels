<?php

namespace App\Http\Foundation;

use Illuminate\Http\Request;

abstract class Providers
{
    protected string $base_url;
    protected $data;
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract protected function http_build_query() :array;
    abstract protected function hotelName() :string;
    abstract protected function rate() :int;
    abstract protected function price() :int;
    abstract protected function discount() :int;
    abstract protected function roomAmenities() :string;

    public function getHotels(): array
    {
        return  $this->hit();
    }

    private function hit(): array
    {
        $curl_init = curl_init();
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_init, CURLOPT_URL, $this->base_url);
        $content = curl_exec($curl_init);
        return $this->results(json_decode($content));
    }

    private function responseFormat() :array
    {
        return [
            'hotel' => $this->hotelName(),
            'rate' => $this->rate(),
            'price' => $this->price(),
            'discount' => $this->discount(),
            'roomAmenities' => $this->roomAmenities(),
        ];
    }

    private function results($response): array
    {
        return array_map(function ($hotel) {
            $this->data = $hotel;
            return $this->responseFormat();
        }, $response);
    }
}
