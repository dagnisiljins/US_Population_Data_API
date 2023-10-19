<?php

declare(strict_types=1);

namespace App;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiData
{
    private string $api;
    private Client $httpClient;

    public function __construct(string $api)
    {
        $this->api = $api;
        $cafile = 'C:/CA certificates/cacert.pem';
        $this->httpClient = new Client([
            'verify' => $cafile,
        ]);
    }

    public function search(): ?PopulationByYearCollection
    {
        $url = $this->api;

        try {
            $response = $this->httpClient->get($url);
        } catch (GuzzleException $e) {
            echo "Failed to fetch data from the API: " . $e->getMessage() . "\n";
            return null;
        }

        $body = $response->getBody()->__toString();
        $data = json_decode($body, true);

        if ($data === false) {
            echo "Failed to fetch data from the API.\n";
            return null;
        }


        if ($data === null) {
            echo "Failed to decode JSON data.\n";
            return null;
        }

        $collection = new PopulationByYearCollection();

        foreach ($data['data'] as $entry) {
            $nation = $entry['Nation'] ?? null;
            $year = $entry['Year'] ?? null;
            $population = $entry['Population'] ?? null;

            if ($nation !== null && $year !== null && $population !== null) {
                $collection->add(new PopulationByYear($nation, $year, $population));
            }
        }

        return $collection;
    }
}