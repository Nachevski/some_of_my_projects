<?php
//username = Tanja
//password = tanja123

require_once('App/require_all.php');
require_once('App/Processing/init.php');

if (checkIfPOST() && isset($_POST['registration-number']) && $_POST['registration-number'] != '') {
    $registrationNumber = $_POST['registration-number'];
    $matchedVehicle = findRegistrationNumber($registrationNumber);
    $searchFlag = true;
}
if (isset($_SESSION['loggedAdmin'])) {
    header('LOCATION:./App/Dashboard.php');
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
                echo '<span style="margin-right: 15px">Logged as: <strong class="text-success">' . $_SESSION['loggedAdmin'] . '</strong></span>
                      <a href="App/Processing/logout.php" class="btn btn-primary">Logout</a>';
                echo '<a href="App/Dashboard.php" class="btn btn-primary ms-3">Registrations</a>';

            } else {
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
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
        <div class="col-8 offset-2 p-5 text-center bg-secondary-subtle">
            <h1>Vehicle Registration</h1>
            <div class="row">
                <div class="col-6 offset-3 mt-3">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="registration-number" class="form-label">Enter your registration number to check
                                its availability</label>
                            <input type="text" class="form-control" id="registration-number"
                                   name="registration-number" placeholder="Registration Number">
                        </div>
                        <button type="submit" class="btn btn-primary w-25">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if (isset($searchFlag) && !empty($matchedVehicle)) {
    $counter = 1;
    echo '<div class="container-fluid">
            <div class="row">
                <div class="col-8 offset-2 mt-5">
                    <table class="table mt-5 p-5 border">
                      <thead>
                        <tr class="table-primary">
                          <th scope="col">#</th>
                          <th scope="col">Vehicle Model</th>
                          <th scope="col">Vehicle Type</th>
                          <th scope="col">Vehicle VIN Number</th>
                          <th scope="col">Production Year</th>
                          <th scope="col">Registration Number</th>
                          <th scope="col">Fuel Type</th>
                          <th scope="col">Registration Date</th>
                        </tr>
                      </thead>
                      <tbody>';
    foreach ($matchedVehicle as $key => $match) {
        echo '            <tr>
                              <th scope="row">' . $counter++ . '</th>
                              <td class="border">' . $match->getVehicleModel() . '</td>
                              <td class="border">' . $match->getVehicleType() . '</td>
                              <td class="border">' . $match->getVehicleVIN() . '</td>
                              <td class="border">' . $match->getProductionYear() . '</td>
                              <td class="border">' . $match->getRegistrationNumber() . '</td>
                              <td class="border">' . $match->getVehicleFuelType() . '</td>
                              <td class="border">' . $match->getRegistrationDate() . '</td>';
    }
    echo '                </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>';

} elseif (isset($searchFlag) && empty($matchedVehicle)) {
    echo '<div class="container-fluid">
             <div class="row mt-5">
                <div class="col-8 offset-2 mt-5 pt-3 pb-3 text-center text-danger border">
                <h5>Registration Number: "' . $registrationNumber . '" Not found' . '<h5>
                </div>
            </div>
        </div>';
}
?>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-5 text-center bg-secondary-subtle">
                        <h1>Login</h1>
                        <div class="row">
                            <div class="col-6 offset-3 mt-3">
                                <form action="App/Processing/login.php" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                               aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
