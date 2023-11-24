<?php
require_once('./../require_all.php');

use App\Database\Database;
use App\Database\SQLQuery as SQLQuery;

isAdminLogged();

if (checkIfPOST()) {
    if (!hasEmptyInputs($_POST)) {
        $objectDataID = $_SESSION['tempObject'][0];
        $objectData = $_SESSION['tempObject'][1];
        if ((!checkIfVINNumberExists($_POST['vehicleVIN']) || $objectData->getVehicleVIN() == $_POST['vehicleVIN']) &&
            (!checkIfRegistrationNumberExists($_POST['registrationNumber']) || $objectData->getRegistrationNumber() == $_POST['registrationNumber'])) {
//        SAVING NEW DATA DO DB
            $query = new SQLQuery();
            $query->editRecord($_POST);
            Database::terminateConnection();

            $_SESSION['tempObject'] = null;
            $_SESSION['tempRecordID'] = null;
            $_SESSION['success'] = 'Record Updated Successfully';

            header('LOCATION:../Dashboard.php');
            die();
        } else {
            $_SESSION['error'] = 'VIN or Registration Number Already Exists!';
            header('LOCATION:../EditRecord.php');
            die();
        }
    } else {
        $_SESSION['error'] = 'No Empty Inputs Allowed!';
        header('LOCATION:../EditRecord.php');
        die();
    }
}
header('LOCATION:../../index.php');
die();
