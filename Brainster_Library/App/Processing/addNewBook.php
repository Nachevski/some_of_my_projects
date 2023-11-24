<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    addNewBook($_POST);
    header('LOCATION: ../books.php');
    die();
}
?>