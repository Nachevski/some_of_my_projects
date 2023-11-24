<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

use App\Database\SQLQuery;

require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['bookID'])) {
        $conn = new SQLQuery();
        $book = $conn->getBookByID($_GET['bookID']);
        echo json_encode($book);

    }
}