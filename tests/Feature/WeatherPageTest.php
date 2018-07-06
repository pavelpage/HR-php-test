<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherPageTest extends TestCase
{
    public function test_user_can_see_weather_page()
    {
        $this->get(route('weather.index'))
            ->assertStatus(200);
    }
}
