<?php
declare(strict_types=1);

use App\Classes\RegisteredVehicles;
use App\Classes\VehicleModel;
use App\Database\SQLQuery;

function isAdminLogged(): void
{
    if (!isset($_SESSION['loggedAdmin'])) {
        header('LOCATION:../index.php');
    }
}

function checkIfPOST(): bool
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

function findObject($id): array
{
    foreach ($_SESSION['RegisteredVehicles'] as $key => $vehicle) {
        if ($vehicle->getObjectID() == $id) {
            $_SESSION['tempObjectID'] = $key;
            return array($key, $vehicle);
        }
    }
}

function hasEmptyInputs($data): bool
{
    foreach ($data as $input) {
        if ($input == '' || $input == 'Default Select') return true;
    }
    return false;
}

function checkIfVINNumberExists($vehicleVIN): bool
{
    foreach ($_SESSION['RegisteredVehicles'] as $vehicle) {
        if (strtolower($vehicle->getVehicleVIN()) == strtolower($vehicleVIN)) {
            return true;
        }
    }
    return false;
}

function checkIfRegistrationNumberExists($registrationNumber): bool
{
    foreach ($_SESSION['RegisteredVehicles'] as $vehicle) {
        if (strtolower($vehicle->getRegistrationNumber()) == strtolower($registrationNumber)) {
            return true;
        }
    }
    return false;
}

function checkIfModelExists($newModel): bool
{
    $newModel = strtolower($newModel);
    foreach ($_SESSION['VehicleModel'] as $model) {
        if (strtolower($model->getVehicleModel()) == $newModel) {
            return true;
        }
    }
    return false;
}

function findModelOfVehicle($id): string|null
{
    foreach ($_SESSION['VehicleModel'] as $model) {
        if ($model->getVehicleModelID() == $id) {
            return $model->getVehicleModel();
        }
    }
}

function findTypeOfVehicle($id): string|null
{
    foreach ($_SESSION['VehicleTypes'] as $type) {
        if ($type->getVehicleTypeID() == $id) {
            return $type->getVehicleType();
        }
    }
}

function findTypeOfFuel($id): string|null
{
    foreach ($_SESSION['VehicleFuelTypes'] as $fuelType) {
        if ($fuelType->getVehicleFuelTypeID() == $id) {
            return $fuelType->getVehicleFuelType();
        }
    }
}

function findRegistrationNumber($number): array|null
{
    $registrationNumber = strtolower($number);
    $_POST['registration-number'] = '';
    $matchedObjects = [];
    foreach ($_SESSION['RegisteredVehicles'] as $key => $record) {
        if (strstr(strtolower($record->getRegistrationNumber()), $registrationNumber)) {
            $matchedObjects += array($key => $record);
        }
    }
    return $matchedObjects;
}


//IF OPTIONAL VALUE IS SENT, IT CHECKS BETWEEN TWO DATES WHERE OPTIONAL IS LIKE TODAY DATE.
//IF NOT SENT IT TAKE CURRENT DATE TO PROCESS AND FINDS DIFFERENCES IN DAYS
function dateDifference($date, $optional = null): int
{
    if (!is_null($optional)) {
        $currentDate = explode('/', $optional);
    } else {
        $currentDate = explode('/', Date("d/m/Y"));
    }
    $registrationDate = explode('/', $date);

    $todayDateToDays = (((int)$currentDate[0]) + ((int)$currentDate[1] * 30) + ((int)$currentDate[2] * 365));
    $registrationDateToDays = (((int)$registrationDate[0]) + ((int)$registrationDate[1] * 30) + ((int)$registrationDate[2] * 365));

    return ($registrationDateToDays - $todayDateToDays);

}

function registrationDateStatus($date): string|null
{
    $warningDays = 30;
    $registrationExpired = 'red';
    $registrationBeforeExpiration = '#ffda00';
    if ($date < 0) {
        return $registrationExpired;
    } elseif ($date <= $warningDays && $date > 0) {
        return $registrationBeforeExpiration;
    } else {
        return null;
    }
}

function updateData(): void
{
    $query = new SQLQuery();
    $_SESSION['RegisteredVehicles'] = null;
    $_SESSION['VehicleModel'] = null;

    foreach ($query->getAllVehicles() as $vehicle) {
        $_SESSION['RegisteredVehicles'][] = new RegisteredVehicles($vehicle);
    }

    foreach ($query->getVehicleModels() as $vehicle) {
        $_SESSION['VehicleModel'][] = new VehicleModel($vehicle);
    }
}