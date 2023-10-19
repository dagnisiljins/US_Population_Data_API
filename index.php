<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\ApiData;
use Carbon\Carbon;

echo 'Welcome to US public data app. App provides a US population data by years.' . PHP_EOL;
echo PHP_EOL;

$api = 'https://datausa.io/api/data?drilldowns=Nation&measures=Population';
$apiData = new ApiData($api);
$collection = $apiData->search();

if (empty($collection->getPopulationByYears())) {
    exit("No records found. \n");
}

/*foreach ($collection->getPopulationByYears() as $populationByYear) {
    echo 'Nation: ' . $populationByYear->getNation() . PHP_EOL;
    echo 'Year: ' . $populationByYear->getYear() . PHP_EOL;
    echo 'Population: ' . $populationByYear->getPopulation() . PHP_EOL;
    echo '------------------------------------------------------------------------' . PHP_EOL;
}*/

$populationData = $collection->getPopulationByYears();

for ($i = 1; $i < count($populationData); $i++) {
    $currentYear = $populationData[$i]->getYear();
    $previousYear = $populationData[$i - 1]->getYear();
    $currentPopulation = $populationData[$i]->getPopulation();
    $previousPopulation = $populationData[$i - 1]->getPopulation();

    $currentDate = Carbon::createFromDate($currentYear);
    $previousDate = Carbon::createFromDate($previousYear);
    $yearDifference = $currentDate->diffInYears($previousDate);

    $populationDifference = $currentPopulation - $previousPopulation;

    echo "Nation: " . $populationData[$i]->getNation() . PHP_EOL;
    echo "Year: $currentYear" . PHP_EOL;
    echo "Population: $currentPopulation" . PHP_EOL;
    echo "Population Difference from $previousYear ($yearDifference year): $populationDifference" . PHP_EOL;
    echo "----------------------------------" . PHP_EOL;
}

