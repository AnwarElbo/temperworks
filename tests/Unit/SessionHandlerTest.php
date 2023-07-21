<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\Utils\SessionHandler;

class SessionHandlerTest extends TestCase
{
    private array $sessions;
    private SessionHandler $sessionHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->sessions = [];
        $this->sessionHandler = new SessionHandler($this->sessions);
    }

    public function testCreateOrFetchParkingLot(): void
    {
        $expectedParkingSpots = 15;
        $createdParkingLot = $this->sessionHandler->createOrFetchParkingLot($expectedParkingSpots);

        $this->assertSame($expectedParkingSpots, $createdParkingLot->countFreeSpaces());

        $fetchedParkingLot = $this->sessionHandler->createOrFetchParkingLot(200);

        $this->assertSame($expectedParkingSpots, $fetchedParkingLot->countFreeSpaces());
        $this->assertSame($expectedParkingSpots, unserialize($this->sessions['parking_lot'])->countFreeSpaces());
    }

    public function testReset(): void
    {
        $this->sessionHandler->createOrFetchParkingLot();
        $this->assertNotEmpty($this->sessions);

        $this->sessionHandler->reset(false);
        $this->assertEmpty($this->sessions);
    }
}