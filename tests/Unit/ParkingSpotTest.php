<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Temperworks\Codechallenge\Exceptions\VehicleCrashException;
use Temperworks\Codechallenge\ParkingSpot;
use Temperworks\Codechallenge\Vehicles\VehicleInterface;

class ParkingSpotTest extends TestCase
{
    use ProphecyTrait;

    private ParkingSpot $parkingSpot;

    public function setUp(): void
    {
        parent::setUp();

        $this->parkingSpot = new ParkingSpot();
    }

    public function testOccupyingParkingSpot(): void
    {
        $this->assertSame(null, $this->parkingSpot->currentlyOccupiedBy());

        $vehicle = $this->prophesize(VehicleInterface::class);
        $vehicle->toString()->willReturn('test');

        // Success
        $this->parkingSpot->occupyItBy($vehicle->reveal());
        $this->assertInstanceOf(VehicleInterface::class, $this->parkingSpot->currentlyOccupiedBy());

        // Fail
        $this->expectException(VehicleCrashException::class);
        $this->expectExceptionMessage('Parking spot was already occupied by: test');
        $this->parkingSpot->occupyItBy($vehicle->reveal());
    }

    public function testMakeAvailable(): void
    {
        $vehicle = $this->prophesize(VehicleInterface::class);
        $vehicle->toString()->willReturn('test vehicle');

        $this->parkingSpot->occupyItBy($vehicle->reveal());
        $this->assertSame('test vehicle', $this->parkingSpot->currentlyOccupiedBy()->toString());

        $this->parkingSpot->makeAvailable();
        $this->assertEmpty($this->parkingSpot->currentlyOccupiedBy());
    }
}