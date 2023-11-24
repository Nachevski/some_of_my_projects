<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

use App\Database\SQLQuery;

require_once("../../importAll.php");

if ($_SERVER['REQUEST_METHOD'] = 'GET' && (isset($_GET['bookID']) || isset($_GET['noteID']))) {

    $bookID = $_GET['bookID'] ?? null;
    $userID = $_SESSION['loggedUserID'];
    $noteID = $_GET['noteID'] ?? null;
    if (isset($_GET['bookID'])) {
        $conn = new SQLQuery();
        $myNotes = $conn->updateNotes($bookID, $userID);
        echo json_encode($myNotes);
        die();
    }
    if (isset($_GET['noteID'])) {
        $conn = new SQLQuery();
        $myNotes = $conn->getNoteByID($noteID);
        echo json_encode($myNotes);
        die();
    }
}


if ($_SERVER['REQUEST_METHOD'] = 'POST' && (isset($_POST['bookID']) || isset($_POST['deleteNoteID']) || isset($_POST['noteID']))) {
    $data = $_POST;
    $data['userID'] = $_SESSION['loggedUserID'];
    $userID = $_SESSION['loggedUserID'];
    $noteID = $_POST['deleteNoteID'] ?? null;
    $updateNoteID = $_POST['noteID'] ?? null;
    unset($data['callFrom']);

    if (isset($_POST['deleteNoteID'])) {
        $conn = new SQLQuery();
        $myNotes = $conn->deleteNote($noteID);
        echo json_encode(['succ' => true]);
    }

    if (isset($_POST['noteID'])) {
        $newNote = $_POST['editNote'];
        $conn = new SQLQuery();
        $myNotes = $conn->updateNoteByID($updateNoteID, $newNote);
        echo json_encode(['succ' => true]);
    }


    if (isset($_POST['bookID'])) {
        $conn = new SQLQuery();
        $conn->createNewNote($data);
        $conn = new SQLQuery();
        $myNotes = $conn->updateNotes($data['bookID'], $userID);
        echo json_encode($myNotes);

        die();
    }


}



