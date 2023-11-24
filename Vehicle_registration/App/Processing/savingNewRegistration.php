<?php
require_once('./../require_all.php');

use App\Database\Database;
use App\Database\SQLQuery as SQLQuery;

if (checkIfPOST()) {
    if (!hasEmptyInputs($_POST)) {
        if (!checkIfVINNumberExists($_POST['vehicleVIN']) && !checkIfRegistrationNumberExists($_POST['registrationNumber'])) {
//        SAVING NEW DATA DO DB
            $query = new SQLQuery();
            $query->saveNewRegistration($_POST);
            $getLastRecord = $query->getLastAddedVehicle();
            Database::terminateConnection();

            $_SESSION['success'] = 'New Registration Saved Successfully';
        } else {
            $_SESSION['error'] = 'VIN or Registration Number Already Exists!';
        }
    } else {
        $_SESSION['error'] = 'No Empty Inputs Allowed!';
    }
    header('LOCATION:../Dashboard.php');
}


