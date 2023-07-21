<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Temperworks\Codechallenge\ParkingLot;
use Temperworks\Codechallenge\Vehicles\VehicleInterface;

class ParkingLotTest extends TestCase
{
    use ProphecyTrait;

    private ParkingLot $parkingLot;
    private int $totalParkingSpots;

    public function setUp(): void
    {
        parent::setUp();

        $this->totalParkingSpots = 10;
        $this->parkingLot = new ParkingLot($this->totalParkingSpots);
    }

    public function testCountFreeSpaces(): void
    {
        $this->assertSame($this->totalParkingSpots, $this->parkingLot->countFreeSpaces());
    }

    /**
     * @dataProvider parkVehicleProvider
     */
    public function testParkVehicle(int $amountVehicles, bool $expected): void
    {
        $vehicle = $this->prophesize(VehicleInterface::class);

        $result = null;

        for($i = 0; $i < $amountVehicles; $i++) {
            $result = $this->parkingLot->parkVehicle($vehicle->reveal());
        }

        $this->assertSame($expected, $result);
    }

    public function parkVehicleProvider(): array
    {
        return [
            [5, true],
            [8, true],
            [2, true],
            [11, false],
        ];
    }

    public function testRemoveVehicle(): void
    {
        $vehicle = $this->prophesize(VehicleInterface::class);

        $this->assertSame($this->totalParkingSpots, $this->parkingLot->countFreeSpaces());

        $this->parkingLot->parkVehicle($vehicle->reveal());
        $this->assertSame($this->totalParkingSpots - 1, $this->parkingLot->countFreeSpaces());

        $this->parkingLot->removeVehicle();
        $this->assertSame($this->totalParkingSpots, $this->parkingLot->countFreeSpaces());
    }

    public function testGetOccupiedParkingSpots(): void
    {
        $this->assertEmpty($this->parkingLot->getOccopiedParkingSpots());

        $vehicle = $this->prophesize(VehicleInterface::class);
        $this->parkingLot->parkVehicle($vehicle->reveal());
        $this->assertCount(1, $this->parkingLot->getOccopiedParkingSpots());

    }
}