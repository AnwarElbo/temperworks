<?php

namespace Temperworks\Codechallenge\Utils;

class FormHandler
{
    private SessionHandler $sessionHandler;
    private CarFactory $carFactory;
    public string $message;

    public function __construct(SessionHandler $sessionHandler)
    {
        $this->carFactory = new CarFactory();
        $this->sessionHandler = $sessionHandler;
    }

    public function handle(): void
    {
        if ($this->isButtonClicked('reset')) {
            $this->sessionHandler->reset();
        }

        $parkingLot = $this->sessionHandler->createOrFetchParkingLot();

        if ($this->isButtonClicked('parkNewCar')) {
            if ($parkingLot->parkVehicle($this->carFactory->create())) {
                $this->message = 'Welcome, please go in';
            } else {
                $this->message = 'Sorry, no place left';
            }
        }

        if ($this->isButtonClicked('parkOutCar')) {
            $parkingLot->removeVehicle();
        }

        $this->sessionHandler->save('parking_lot', $parkingLot);
    }

    private function isButtonClicked(string $buttonName): bool
    {
        return array_key_exists($buttonName, $_POST);
    }
}