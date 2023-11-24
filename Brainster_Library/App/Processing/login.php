<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $getUser = getUserByName($username);

    var_dump($getUser);
    if (!empty($getUser) && password_verify($password, $getUser['password'])) {
        if ($getUser['is_admin'] == 1) {
            $_SESSION['userRole'] = 777;
        }
        $_SESSION['loginStatus'] = true;
        $_SESSION['loggedUser'] = $getUser['username'];
        header('LOCATION: ../../index.php');
        die();
    }
    $_SESSION['loginStatus'] = false;
}
header('LOCATION: ../../index.php');
