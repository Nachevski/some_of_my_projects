<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

use App\Database\SQLQuery;

require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['categories'])) {
        $conn = new SQLQuery();
        $categories = $conn->getCategories();
        echo json_encode($categories);
    }
    if (isset($_GET['categoryID'])) {
        $conn = new SQLQuery();
        $category = $conn->getCategoryByID($_GET['categoryID']);
        echo json_encode($category);
    }
}