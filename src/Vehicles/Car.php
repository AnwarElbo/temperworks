<?php

namespace Temperworks\Codechallenge\Vehicles;

class Car implements VehicleInterface
{
    private string $color;
    private string $model;
    private string $type;

    public function __construct(string $model, string $type, string $color)
    {
        $this->model = $model;
        $this->color = $color;
        $this->type = $type;
    }

    public function toString(): string
    {
        return 'Car model: ' . $this->model . ', type: ' . $this->type . ', color: ' . $this->color;
    }
}