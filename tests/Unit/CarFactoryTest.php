<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\Utils\CarFactory;
use Temperworks\Codechallenge\Vehicles\Car;

class CarFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $carFactory = new CarFactory();
        $this->assertInstanceOf(Car::class, $carFactory->create());
    }
}