<?php
require_once('./../require_all.php');


if (checkIfPOST()) {
    if ((!empty($_POST['username']) && !empty($_POST['password']))) {
        foreach ($_SESSION['ADMINS'] as $admin) {
            if ($admin->getUsername() == $_POST['username'] &&
                password_verify($_POST['password'], $admin->getPassword())) {
                $_SESSION['loggedAdmin'] = $admin->getUsername();
                header('LOCATION:../Dashboard.php');
                die();
            }
        }
        $_SESSION['error'] = 'Login Fail! Wrong Credentials Provided!';
    }
}
header('LOCATION:../../index.php');