<?php
require_once('load_all.php');

use App\Database\SQLQuery as SQLQuery;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    validateData();
} else {
    header('LOCATION:../index.php');
}


function validateData()
{
    $errorValidation = [];
    $passValidation = [];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errorValidation += array($key => "This field is required!");
            continue;
        }
        if (str_contains($key, 'ImgURL')) {
            if (!checkIfIMGAreValid($value)) {
                $errorValidation += array($key => "Invalid image URL entered");
                continue;
            }
        }
        if ($key == 'phoneNumber') {
            if (!checkIsValidNumber($value)) {
                $errorValidation += array($key => "Enter a valid number!");
                continue;
            }
        }

        if (str_contains($key, 'Social')) {
            if (!checkIsValidURL($value)) {
                $errorValidation += array($key => "URL is not valid!");
                continue;
            };
        }
        $passValidation += array($key => $value);
    }

    if (empty($errorValidation)) {
        saveDataToDB();
    } else {
        $_SESSION['validatedFields'] = $passValidation;
        $_SESSION['validationErrors'] = $errorValidation;
        header('LOCATION:./createNewPage.php?validationStatus=Error');
    }
}

//FUNCTION TO CHECK IF PROVIDED URL FOR IMAGES ARE VALID! CHECKS IF THERE IS VALID IMAGE IN LINK AND
// COMPARE IT WITH ALLOWED EXTENSION, IF MATCH RETURNS TRUE

//!!!!NOTE!!!!! IT USES SOME TIME TO CHECK LINK FROM URL SOURCES IF IS VALID IMAGE!
// (IN MY TESTING 2-5 SECONDS TO CHECK FOR ALL LINKS PROVIDED, DEPENDS FROM SOURCE AND SERVER RESPONSE TIME!)

function checkIfIMGAreValid(string $url)
{
    $allowedExtensions = ['image/gif', 'image/jpeg', 'image/png', 'image/bmp'];
    $result = getimagesize($url);
    if (in_array($result['mime'], $allowedExtensions)) {
        return true;
    }
    return false;
}

function checkIsValidURL($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    }
    return false;
}

function checkIsValidNumber($number)
{
    if (is_numeric($number)) {
        return true;
    }
    return false;
}

function saveDataToDB()
{
    $query = new SQLQuery();
    $query->saveDataToDB($_POST);
    header("LOCATION:../Template/template.php?ID={$_SESSION['userID']}");
}

?>


