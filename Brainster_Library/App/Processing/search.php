<?php
require_once("../importAll.php");
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if (isset($_GET)) {
    $searchString = $_GET['search'];
    $result = search($searchString);
}
