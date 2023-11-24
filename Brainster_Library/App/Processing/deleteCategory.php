<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoryID'])) {
    deleteCategory($_POST['categoryID']);
    header("LOCATION: ../categories.php");
//    header("LOCATION: ../" . $_POST['callFrom'] . ".php");
}