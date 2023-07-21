<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/app.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Temper Works App
        </title>
    </head>
    <body>
        <h3>
            Free spaces: <?php echo $parkingLot->countFreeSpaces(); ?>
        </h3>
        <br/>
        <form method="POST" action="/index.php">
            <?php echo $formHandler->message ?? '' ?>

            <br/>
            <br/>
            <button name="parkNewCar">Park a car</button>
            <button name="parkOutCar" <?php echo (count($parkingLot->getOccopiedParkingSpots()) === 0 ? 'disabled' : '') ?>>Park out a car</button>
            <button name="reset">Reset</button>

            <br/>
            <br/>

            <?php foreach ($parkingLot->getOccopiedParkingSpots() as $occopiedParkingSpot): ?>
                <?php echo $occopiedParkingSpot->currentlyOccupiedBy()->toString(); ?>
                <br/>
            <?php endforeach; ?>
        </form>
    </body>
</html>
