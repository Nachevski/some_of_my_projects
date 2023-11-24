<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    modifyBook($_POST);
    header('LOCATION: ../books.php');
    die();
}