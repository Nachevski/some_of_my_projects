<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentID'])) {
    deleteBook($_POST['commentID']);
    header("LOCATION: ../books.php");
//    header("LOCATION: ../" . $_POST['callFrom'] . ".php");
}