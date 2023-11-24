<?php
require_once('./../require_all.php');

use App\Database\Database;
use App\Database\SQLQuery;

if (checkIfPOST() && isset($_SESSION['tempID'])) {
//        DELETING DATA FROM DB
    $query = new SQLQuery();
    $query->deleteRecord($_SESSION['tempID']);
    Database::terminateConnection();
//        UPDATING OBJECT
    $dataObject = findObject($_SESSION['tempID']);
    array_splice($_SESSION['RegisteredVehicles'], $dataObject[0], 1);
    
    $_SESSION['success'] = 'Record Deleted Successfully!';
    $_SESSION['tempID'] = null;
    $_SESSION['tempObject'] = null;
    header('LOCATION:../Dashboard.php');
    die();
}
header('LOCATION:../index.php');

