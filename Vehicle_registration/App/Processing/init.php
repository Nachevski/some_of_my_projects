<?php

use App\Classes\VehicleFuelType as VehicleFuelType;
use App\Classes\VehicleModel as VehicleModel;
use App\Classes\VehicleType as VehicleType;
use App\Database\SQLQuery as SQLQuery;
use App\Classes\RegisteredVehicles as RegisteredVehicles;
use App\Classes\Admin as Admin;


//RESTING EVERYTHING FOR FIRST LOAD EXCEPT LOGGED USER IF SET IN SESSION ON INDEX LOAD
$_SESSION['LoadStatus'] = null;


if (!isset($_SESSION['LoadStatus'])) {

    $_SESSION['RegisteredVehicles'] = null;
    $_SESSION['VehicleFuelTypes'] = null;
    $_SESSION['VehicleTypes'] = null;
    $_SESSION['ADMINS'] = null;

    $query = new SQLQuery();

    foreach ($query->getAllVehicles() as $vehicle) {
        $_SESSION['RegisteredVehicles'][] = new RegisteredVehicles($vehicle);
    }

    foreach ($query->getVehicleFuelTypes() as $vehicle) {
        $_SESSION['VehicleFuelTypes'][] = new VehicleFuelType($vehicle);
    }

    foreach ($query->getVehicleTypes() as $vehicle) {
        $_SESSION['VehicleTypes'][] = new VehicleType($vehicle);
    }

    foreach ($query->getAdmins() as $admin) {
        $_SESSION['ADMINS'][] = new Admin($admin);
    }

    $_SESSION['LoadStatus'] = true;

}
