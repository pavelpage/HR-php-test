<?php

namespace Tests\Unit;

use App;
use App\Weather;
use Cache;
use Tests\TestCase;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;


class WeatherClassTest extends TestCase
{

    public function test_it_return_temperature_value_from_cache()
    {
        Cache::shouldReceive('remember')
            ->once()
            ->andReturn(24);

        $weather = App::make(Weather::class);

        $this->assertEquals(24, $weather->getTemperature());
    }

    public function test_it_can_get_request_data_from_api_server()
    {
        $responseData = [
            'fact' => [
                "temp" => 24,
            ],
        ];
        $statusCode = 200;

        $this->createMockResponse($responseData, $statusCode);

        $weather = App::make(Weather::class);
        $response = $weather->getApiResponse(1.1,2.2);

        $data = json_decode($response->getBody()->getContents());

        $this->assertEquals(24, $data->fact->temp);
    }

    public function test_it_returns_false_for_invalid_data_from_api_server()
    {
        $responseData = [
            'wrong' => [
                "temp" => 24,
            ],
        ];
        $statusCode = 403;

        $this->createMockResponse($responseData, $statusCode);

        $weather = App::make(Weather::class);
        $value = $weather->getCurrentTemperature(1.1,2.2);

        $this->assertEquals(false, $value);
    }

    private function createMockResponse($responseData, $statusCode)
    {
        $headers = ['Content-Type' => 'application/json'];
        $body = json_encode($responseData);

        $response = new Response($statusCode, $headers, $body);

        $mock = new MockHandler([
            $response
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->app->instance(Client::class, $client);

        return $response;
    }
}
