<?php

declare(strict_types=1);

namespace App;

class PopulationByYearCollection
{

    private array $populationByYears;

    public function __construct(array $populationByYears = [])
    {
        foreach ($populationByYears as $populationByYear)
        $this->add($populationByYear);
    }

    public function add(PopulationByYear $populationByYear)
    {
        $this->populationByYears [] = $populationByYear;
    }
    public function getPopulationByYears(): array
    {
        return $this->populationByYears;
    }
}