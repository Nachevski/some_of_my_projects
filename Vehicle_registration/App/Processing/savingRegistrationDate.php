<?php
require_once('../require_all.php');

use App\Database\Database;
use App\Database\SQLQuery as SQLQuery;

if (checkIfPOST() && isset($_POST['newRegDate']) && !empty($_POST['newRegDate'])) {
    $objectDataID = $_SESSION['tempObject'][0];
    $objectData = $_SESSION['tempObject'][1];
    $registrationDate = $objectData->getRegistrationDate();
    $dateDiff = dateDifference($_POST['newRegDate'], $objectData->getRegistrationDate());
    if ($dateDiff > 0) {
//        SAVING NEW DATA DO DB
        $query = new SQLQuery();
        $query->extendRegistrationDate(['registrationDate' => $_POST['newRegDate'], 'recordID' => $_SESSION['tempRecordID']]);
        Database::terminateConnection();
//        UPDATING OBJECT
//        $_SESSION['RegisteredVehicles'][$objectDataID]->setRegistrationDate($_POST['newRegDate']);

        $_SESSION['success'] = 'New Registration Date Saved Successfully';
        $_SESSION['tempObject'] = null;
        $_SESSION['tempRecordID'] = null;
        header("LOCATION:../Dashboard.php");
        die();
    } elseif ($dateDiff == 0) {
        $_SESSION['error'] = "You Cannot Enter The Same Date!";
    } else {
        $_SESSION['error'] = "Entered date is " . abs($dateDiff) . " Days Before Registration Date! Please Enter Valid Date!";
    }
} elseif (isset($_POST['newRegDate']) && empty($_POST['newRegDate'])) {
    $_SESSION['error'] = "Empty Inputs Is Not Allowed!";
}
header("LOCATION:../ExtendRegistration.php");
