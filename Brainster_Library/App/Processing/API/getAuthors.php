<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

use App\Database\SQLQuery;

require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['authorID'])) {
        $conn = new SQLQuery();
        $authors = $conn->getAuthorByID($_GET['authorID']);
        echo json_encode($authors);
    }

    if (isset($_GET['authors'])) {
        $conn = new SQLQuery();
        $authors = $conn->getAuthorData();
        echo json_encode($authors);
    }

}