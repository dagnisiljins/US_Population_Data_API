<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\ApiData;

echo 'Welcome to US public data app. App provides a US population data by years.';
echo PHP_EOL;

$api = 'https://datausa.io/api/data?drilldowns=Nation&measures=Population';
$apiData = new ApiData($api);
$collection = $apiData->search();

if (empty($collection->getPopulationByYears())) {
    exit("No records found. \n");
}

foreach ($collection->getPopulationByYears() as $populationByYear) {
    echo 'Nation: ' . $populationByYear->getNation() . PHP_EOL;
    echo 'Year: ' . $populationByYear->getYear() . PHP_EOL;
    echo 'Population: ' . $populationByYear->getPopulation() . PHP_EOL;
    echo '------------------------------------------------------------------------' . PHP_EOL;
}