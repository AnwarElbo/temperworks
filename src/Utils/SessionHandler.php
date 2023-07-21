<?php

namespace Temperworks\Codechallenge\Utils;

use Temperworks\Codechallenge\ParkingLot;

class SessionHandler
{
    private array $session;

    public function __construct(array &$session)
    {
        $this->session = &$session;
    }

    public function createOrFetchParkingLot(int $createAmountParkingSpots = 10): ParkingLot
    {
        if (! array_key_exists('parking_lot', $this->session)) {
            $this->save('parking_lot', new ParkingLot($createAmountParkingSpots));
        }

        return unserialize($this->session['parking_lot']);
    }

    public function save(string $key, mixed $value): void
    {
        $this->session[$key] = serialize($value);
    }

    public function reset(bool $destroySession = true): void
    {
        $this->session = [];

        $destroySession && session_destroy();
    }
}