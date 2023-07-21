<?php

namespace Temperworks\Codechallenge;

use Temperworks\Codechallenge\Vehicles\VehicleInterface;

class ParkingLot
{
    /**
     * @var ParkingSpot[]
     */
    private array $parkingSpots = [];

    public function __construct(int $amountParkingSpots)
    {
        for ($i = 0; $i < $amountParkingSpots; $i++) {
            $this->parkingSpots[] = new ParkingSpot();
        }
    }

    public function countFreeSpaces(): int
    {
        return count(array_filter($this->parkingSpots, function (ParkingSpot $parkingSpot) {
            return $parkingSpot->isAvailable();
        }));
    }

    public function parkVehicle(VehicleInterface $vehicle): bool
    {
        foreach ($this->parkingSpots as $parkingSpot) {
            // Skip the parking spots that are not available
            if (! $parkingSpot->isAvailable()) {
                continue;
            }

            $parkingSpot->occupyItBy($vehicle);

            return true;
        }

        return false;
    }

    public function removeVehicle(): void
    {
        foreach ($this->parkingSpots as $parkingSpot) {
            // Remove the first vehicle from the lot
            if (! $parkingSpot->isAvailable()) {
                $parkingSpot->makeAvailable();
                return;
            }
        }
    }

    public function getOccopiedParkingSpots(): array
    {
        return array_filter($this->parkingSpots, function (ParkingSpot $parkingSpot) {
            return ! $parkingSpot->isAvailable();
        });
    }
}