<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validateResult = validateInputData($_POST);
    echo json_encode($validateResult);
}