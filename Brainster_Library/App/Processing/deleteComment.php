<?php
require_once("../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentID'])) {
    deleteComment($_POST['commentID']);
    header("LOCATION: ../" . $_POST['callFrom']);
}