<?php

namespace Temperworks\Codechallenge;

use Temperworks\Codechallenge\Exceptions\VehicleCrashException;
use Temperworks\Codechallenge\Vehicles\VehicleInterface;

class ParkingSpot
{
    private ?VehicleInterface $vehicle = null;

    /**
     * @throws VehicleCrashException
     */
    public function occupyItBy(VehicleInterface $vehicle): void
    {
        if (! $this->isAvailable()) {
            throw new VehicleCrashException('Parking spot was already occupied by: ' . $this->vehicle->toString());
        }

        $this->vehicle = $vehicle;
    }

    public function currentlyOccupiedBy(): ?VehicleInterface
    {
        return $this->vehicle;
    }

    public function makeAvailable(): void
    {
        $this->vehicle = null;
    }

    public function isAvailable(): bool
    {
        return $this->vehicle === null;
    }
}