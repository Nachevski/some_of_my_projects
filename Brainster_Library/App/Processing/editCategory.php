<?php
require_once("../importAll.php");
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    modifyCategory($_POST);
    header('LOCATION: ../categories.php');
    die();
}