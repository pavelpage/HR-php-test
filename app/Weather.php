<?php


namespace App;


use Cache;

class Weather
{
    private $key;

    /*
     * This field helps to decrease the count of requests to api.
     */
    private $cacheTime = 10;

    /**
     * Weather constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->key = config('services.weather.yandex.key');
        $this->client = $client;

    }

    /**
     * @param float $lat
     * @param float $lon
     * @return mixed
     */
    public function getTemperature($lat = 53.243325, $lon = 34.363731)
    {

        $value = Cache::remember('temperature', $this->cacheTime, function () use ($lat, $lon){
            return $this->getCurrentTemperature($lat, $lon);
        });

        return $value;
    }

    /**
     * @param $lat
     * @param $lon
     * @return bool | int
     */
    public function getCurrentTemperature($lat, $lon)
    {
        try {
            $response = $this->getApiResponse($lat, $lon);

            $data = json_decode($response->getBody()->getContents());

            return $data->fact->temp;
        }
        catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $lat
     * @param $lon
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getApiResponse($lat, $lon)
    {
        $query = "https://api.weather.yandex.ru/v1/forecast?lat={$lat}&lon={$lon}";

        $client = $this->client;

        $request = $client->request('GET', $query, [
            'headers' => [
                'X-Yandex-API-Key' => $this->key,
            ]
        ]);

        return $request;
    }

}