<?php
require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $userValidation = validateLogin($_POST);

    if (isset($userValidation['success'])) {
        if ($userValidation['userLogged']['is_admin'] == 1) {
            $_SESSION['userRole'] = 777;
        }
        $_SESSION['loginStatus'] = true;
        $_SESSION['loggedUser'] = $userValidation['userLogged']['username'];
        $_SESSION['loggedUserID'] = $userValidation['userLogged']['id'];
        echo json_encode($userValidation);
        die();
    }
    echo json_encode($userValidation);
}
