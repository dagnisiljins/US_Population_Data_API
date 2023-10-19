<?php

declare(strict_types=1);

namespace App;

class PopulationByYear
{

    private string $nation;
    private string $year;
    private int $population;

    public function __construct(string $nation, string $year, int $population)
    {
        $this->nation = $nation;
        $this->year = $year;
        $this->population = $population;
    }

    public function getNation(): string
    {
        return $this->nation;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }
}

