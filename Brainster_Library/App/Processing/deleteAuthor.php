<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['authorID'])) {
    deleteAuthor($_POST['authorID']);
//    header("LOCATION: ../" . $_POST['callFrom'] . ".php");
    header('LOCATION: ../authors.php');
    die();
}