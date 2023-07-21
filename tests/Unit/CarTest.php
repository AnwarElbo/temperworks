<?php

namespace Temperworks\Codechallenge\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Temperworks\Codechallenge\Vehicles\Car;

class CarTest extends TestCase
{
    public function testToString(): void
    {
        $car = new Car('Mercedes', 'SUV', 'blue');
        $this->assertSame('Car model: Mercedes, type: SUV, color: blue', $car->toString());
    }

}