<?php

require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    addNewCategory($_POST);
    header('LOCATION: ../categories.php');
    die();
}
