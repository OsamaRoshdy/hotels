<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetHotelsTest extends TestCase
{
    public function testRequiresFromToCityAndAdults()
    {
        $this->json('GET', 'api/hotels')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'from' => ['The from field is required.'],
                    'to' => ['The to field is required.'],
                    'city' => ['The city field is required.'],
                    'adults' => ['The adults field is required.'],
                ]
            ]);
    }

    public function testHotelsAreListedCorrectly()
    {
        $payload = [
            'from' => now(),
            'to' => now(),
            'city' => 5,
            'adults' => 4,
        ];

        $response = $this->json('GET', '/api/hotels', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                        '*' => [
                            'hotel',
                            'rate',
                            'price',
                            'discount',
                            'roomAmenities',
                        ]
                    ]
            ]);
    }
}
