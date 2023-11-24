<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

use App\Database\SQLQuery;

require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['commentID'])) {
        $conn = new SQLQuery();
        $comment = $conn->getCommentByID($_GET['commentID']);
        echo json_encode($comment);
    }
}