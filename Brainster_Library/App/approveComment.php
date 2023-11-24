<?php
require_once("./importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['commentID'])) {
        approveComment($_POST['commentID'], $_POST['newComment']);
    } else {
        approveComment($_POST['commentID']);
    }
    header("LOCATION: ./" . $_POST['callFrom'] . ".php");
}