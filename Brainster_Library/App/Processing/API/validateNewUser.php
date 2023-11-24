<?php

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validateInputs = validateInputData($_POST);
    if (isset($validateInputs['success'])) {
        $isUsernameExists = isUsernameExists($_POST['username']);

        if (!isset($isUsernameExists['errors'])) {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            createNewUser($_POST);
            $_SESSION['loginStatus'] = true;
            $_SESSION['loggedUser'] = $_POST['username'];
            $_SESSION['loggedUserID'] = getLastCreatedUserID()['id'];
            echo json_encode($isUsernameExists);
            die();
        }
        echo json_encode($isUsernameExists);
        die();
    }
    echo json_encode($validateInputs);
}