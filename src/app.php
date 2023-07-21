<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/Vehicles/VehicleInterface.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Exceptions/VehicleCrashException.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/ParkingLot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/ParkingSpot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Vehicles/Car.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Utils/FormHandler.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Utils/CarFactory.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Utils/SessionHandler.php';

use Temperworks\Codechallenge\Utils\FormHandler;
use Temperworks\Codechallenge\Utils\SessionHandler;

session_start();
$sessionHandler = new SessionHandler($_SESSION);
$formHandler = new FormHandler($sessionHandler);

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $formHandler->handle();
}

$parkingLot = $sessionHandler->createOrFetchParkingLot();
