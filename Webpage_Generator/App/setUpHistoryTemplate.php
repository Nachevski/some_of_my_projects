<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    $templateID = $_GET['ID'];
    $_SESSION['userID'] = $templateID;
    header("LOCATION:../Template/template.php?ID=$templateID");
}
