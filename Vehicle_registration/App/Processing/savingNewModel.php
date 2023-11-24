<?php
require_once('../require_all.php');

use App\Database\Database;
use App\Database\SQLQuery as SQLQuery;

isAdminLogged();
if (checkIfPOST() && !empty($_POST['newModel'])) {
    if (!checkIfModelExists($_POST['newModel'])) {
//        SAVING NEW DATA DO DB
        $query = new SQLQuery();
        $query->insertNewModel($_POST['newModel']);
        $lastID = $query->getLastInsertedID();
        Database::terminateConnection();

        $_SESSION['success'] = 'New Model "' . $_POST['newModel'] . '" Added Successfully';
        header("LOCATION:../Dashboard.php");
        die();
    }
    $_SESSION['error'] = 'You cannot insert "' . $_POST['newModel'] . '"! Already exists in database!';
} else {
    $_SESSION['error'] = "Empty Inputs Is Not Allowed!";
}
header("LOCATION:../insertNewModel.php");
