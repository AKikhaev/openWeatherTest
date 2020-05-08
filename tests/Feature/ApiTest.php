<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ApiTest extends TestCase
{
    /**
     * Success got data.
     *
     * @return void
     */
    public function testCorrectGet()
    {
        $response = $this->get('/api/1.0/weather/omsk');

        $response->assertStatus(200);
        $response->assertJson([
            'name'=>'Omsk'
        ]);
    }

    /**
     * Success got data.
     *
     * @return void
     */
    public function testWrongGet()
    {
        echo __LINE__.PHP_EOL;

        $response = $this->get('/api/1.0/weather/abrakadabra');

        $response->assertStatus(404);
        //$response->assertStatus(404);
    }
}