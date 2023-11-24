<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    addNewAuthor($_POST);
    header('LOCATION: ../authors.php');
    die();
}