<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Temperworks\Codechallenge\ParkingLot;
use Temperworks\Codechallenge\Utils\FormHandler;
use Temperworks\Codechallenge\Utils\SessionHandler;
use Temperworks\Codechallenge\Vehicles\VehicleInterface;

class FormHandlerTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy|SessionHandler $sessionHandler;
    private ParkingLot|ObjectProphecy $parkingLot;

    public function setUp(): void
    {
        $this->sessionHandler = $this->prophesize(SessionHandler::class);
        $this->parkingLot = $this->prophesize(ParkingLot::class);

        $this->sessionHandler->createOrFetchParkingLot()->willReturn($this->parkingLot->reveal())->shouldBeCalled();
        $this->sessionHandler->save('parking_lot', $this->parkingLot->reveal())->shouldBeCalled();
    }

    public function testResetButton(): void
    {
        $_POST['reset'] = 'clicked!';

        $this->sessionHandler->reset()->shouldBeCalled();

        $formHandler = new FormHandler($this->sessionHandler->reveal());
        $formHandler->handle();
    }

    /**
     * @dataProvider parkButtonResultsProvider
     */
    public function testParkButton(bool $isParkinglotFull, string $message): void
    {
        $_POST['parkNewCar'] = 'clicked!';

        $this->parkingLot->parkVehicle(Argument::type(VehicleInterface::class))->shouldBeCalled()->willReturn($isParkinglotFull);

        $formHandler = new FormHandler($this->sessionHandler->reveal());
        $formHandler->handle();
        $this->assertSame($message, $formHandler->message);
    }

    public function parkButtonResultsProvider(): array
    {
        return [
            [true, 'Welcome, please go in'],
            [false, 'Sorry, no place left']
        ];
    }

    public function testParkOutButton(): void
    {
        $_POST['parkOutCar'] = 'clicked!';

        $this->parkingLot->removeVehicle()->shouldBeCalled();
        $formHandler = new FormHandler($this->sessionHandler->reveal());
        $formHandler->handle();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $_POST = [];
    }
}