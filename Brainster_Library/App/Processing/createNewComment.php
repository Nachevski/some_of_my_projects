<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    $data = $_POST;
    $data['userID'] = $_SESSION['loggedUserID'];
    $returnBack = $_POST['callFrom'];
    unset($data['callFrom']);
    createNewComment($data);
    header("LOCATION: ../../" . $_POST['callFrom']);

}