<?php
require_once('./require_all.php');

isAdminLogged();

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

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="container-fluid">
            <div class="row">
                <div class="col bg-danger p-3 text-light text-center">
                    <h4>' . $_SESSION['error'] . '</h4>
                </div>
            </div>
          </div>';
    $_SESSION['error'] = null;
}
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-4 offset-4 p-5 text-center bg-secondary-subtle">
            <h1 class="mb-4">Insert New Model</h1>
            <form action="./Processing/savingNewModel.php" method="POST">
                <label for="newModel" class="form-label">Insert Vehicle Model</label>
                <input type="text" class="form-control " id="newModel"
                       name="newModel" placeholder="Insert new model">
                <button type="submit" class="form-control btn btn-success w-50 mt-3">Insert</button>
                <a href="Dashboard.php" class="form-control btn btn-primary w-50 mt-4">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
