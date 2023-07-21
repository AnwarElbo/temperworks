<?php

namespace Temperworks\Codechallenge\Utils;

use Temperworks\Codechallenge\Vehicles\Car;

class CarFactory
{
    private array $models = ['Mercedes', 'BMW', 'Audi', 'Volkswagen', 'Toyota'];
    private array $types = ['SUV', 'Coupe', 'Sport', 'Sedan'];
    private array $colors = ['blue', 'black', 'green', 'yellow', 'white'];

    public function create(): Car
    {
        $model = $this->models[array_rand($this->models)];
        $type = $this->types[array_rand($this->types)];
        $color = $this->colors[array_rand($this->colors)];

        // Create a car with randomized properties
        return new Car($model, $type, $color);
    }
}