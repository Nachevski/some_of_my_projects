<?php
require_once('./require_all.php');

isAdminLogged();

if (checkIfPOST() && isset($_POST['id'])) {
    $_SESSION['tempID'] = $_POST['id'];
    $dataObject = findObject($_POST['id']);
    $_SESSION['tempObject'] = $dataObject[1];
} else {
    header('LOCATION:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Car regisrtator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Car Registrator</a>
        <div class="login-btn" role="search">
            <?php
            if (isset($_SESSION['loggedAdmin'])) {
                echo '<span style="margin-right: 15px"><strong>Logged as: ' . $_SESSION['loggedAdmin'] . '</strong></span>
                      <a href="Processing/logout.php" class="btn btn-primary">Logout</a>';
            } else {
                echo '<a href="Processing/login.php" class="btn btn-primary">Login</a>';
            }
            ?>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-6 offset-3 p-5 text-center bg-secondary-subtle text-center">
            <h1 class="">Are you sure you want to delete this record?!</h1>
            <h2><?= '"' . $_SESSION['tempObject']->getVehicleModel() . " / " .
                $_SESSION['tempObject']->getRegistrationNumber() . '"' ?></h2>
            <form action="Processing/deletingRegistration.php" method="POST">
                <button type="submit" class="form-control btn btn-danger w-50 mt-3">YES</button>
                <a href="Dashboard.php" class="form-control btn btn-success w-50 mt-4">NO</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>