<?php

require_once('./require_all.php');
require_once('./Processing/advancedSearch.php');

isAdminLogged();
updateData();

//CLICK SEARCH ON EMPTY INPUT TO RELOAD REGISTRATION LIST
if (empty($_POST['searchResults'])) {
    $activeVehicleList = $_SESSION['RegisteredVehicles'] ?? [];
} else {
    $activeVehicleList = advancedSearch($_POST['searchResults']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Car regisrtator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        tbody th, tbody td {
            color: inherit !important;
            font-size: 16px;
        }

        .action {
            padding-right: 0 !important;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Car Registrator</a>
        <div class="login-btn">
            <?php
            if (isset($_SESSION['loggedAdmin'])) {
                echo '<span style="margin-right: 15px">Logged as: <strong class="text-success">' . $_SESSION['loggedAdmin'] . '</strong></span>
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
if (isset($_SESSION['success'])) {
    echo '<div class="container-fluid">
            <div class="row">
                <div class="col bg-success p-3 text-light text-center">
                    <h4>' . $_SESSION['success'] . '</h4>
                </div>
            </div>
          </div>';
    $_SESSION['success'] = null;
}
?>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-8 offset-2 ">
            <a href="InsertNewModel.php" class="btn btn-primary">Insert New Model</a>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-8 offset-2 p-5 text-center bg-secondary-subtle">
            <h1>Vehicle Registration</h1>
            <form action="Processing/savingNewRegistration.php" method="POST" class="text-start">
                <div class="row">
                    <div class="col-6 mt-3">
                        <div class="mb-3">
                            <label for="vehicleModel" class="form-label">Vehicle Model</label>
                            <select class="form-select" name="vehicleModel" id="vehicleModel">
                                <option selected>Default Select</option>
                                <?php
                                foreach ($_SESSION['VehicleModel'] as $vehicle) {
                                    echo '<option value="' . $vehicle->getVehicleModelID() . '">' . $vehicle->getVehicleModel() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleVIN" class="form-label">Vehicle VIN Number</label>
                            <input type="text" class="form-control" id="vehicleVIN"
                                   name="vehicleVIN" placeholder="Vehicle VIN Number">
                        </div>
                        <div class="mb-3">
                            <label for="registrationNumber" class="form-label">Registration Number</label>
                            <input type="text" class="form-control" id="registrationNumber"
                                   name="registrationNumber" placeholder="Vehicle Registration Number">
                        </div>
                        <div class="mb-3">
                            <label for="registrationDate" class="form-label">Registration To</label>
                            <input type="text" class="form-control" id="registrationDate"
                                   name="registrationDate" placeholder="mm/dd/yyyy" pattern="\d{2}/\d{2}/\d{4}">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="mb-3">
                            <label for="vehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-select" name="vehicleType" id="vehicleType">
                                <option selected>Default Select</option>
                                <?php
                                foreach ($_SESSION['VehicleTypes'] as $vehicle) {
                                    echo '<option value="' . $vehicle->getVehicleTypeID() . '">' . $vehicle->getVehicleType() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productionYear" class="form-label">Vehicle Production Year</label>
                            <input type="text" class="form-control" id="productionYear"
                                   name="productionYear" placeholder="yyyy" pattern="\d{4}">
                        </div>
                        <div class="mb-3">
                            <label for="vehicleFuelType" class="form-label">Fuel Type</label>
                            <select class="form-select" name="vehicleFuelType" id="vehicleFuelType">
                                <option selected>Default Select</option>
                                <?php
                                foreach ($_SESSION['VehicleFuelTypes'] as $vehicle) {
                                    echo '<option value="' . $vehicle->getVehicleFuelTypeID() . '">' . $vehicle->getVehicleFuelType() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1 mt-5">
            <div class="d-flex justify-content-end bg-light pt-2 pb-2">
                <form action="" method="POST" class="d-flex w-50">
                    <input class="form-control me-2" name="searchResults"
                           placeholder="Search (you can search with one or multiple words -> 'me A8 77 vW etc..')">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <table class="table border">
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
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($activeVehicleList as $key => $vehicle) : ?>
                    <?php $currentID = $vehicle->getObjectID(); ?>
                    <?php
                    $dateDiff = dateDifference($vehicle->getRegistrationDate());
                    $warningFlag = registrationDateStatus($dateDiff);
                    ?>
                    <tr style="color:<?= $warningFlag ?>">
                        <th scope="row"><?= ++$key ?></th>
                        <td class="border "><?= $vehicle->getVehicleModel() ?></td>
                        <td class="border"><?= $vehicle->getVehicleType() ?></td>
                        <td class="border"><?= $vehicle->getVehicleVIN() ?></td>
                        <td class="border"><?= $vehicle->getProductionYear() ?></td>
                        <td class="border"><?= $vehicle->getRegistrationNumber() ?></td>
                        <td class="border"><?= $vehicle->getVehicleFuelType() ?></td>
                        <td class="border"><?= $vehicle->getRegistrationDate() ?></td>
                        <td class="action d-flex justify-content-evenly">
                            <form action="DeleteRecord.php" method="POST" class="flex-grow-1 me-2">
                                <input name="id" value="<?= $currentID ?>" hidden>
                                <button type="submit" class="btn btn-danger  w-100">Delete</button>
                            </form>
                            <form action="EditRecord.php" method="POST" class="flex-grow-1 me-2">
                                <input name="id" value="<?= $currentID ?>" hidden>
                                <button type="submit" class="btn btn-warning w-100">Edit</button>
                            </form>
                            <form action="./ExtendRegistration.php" method="POST" class="flex-grow-1 me-2"
                                <?= (!isset($warningFlag)) ? 'hidden' : '' ?>>
                                <input name="id" value="<?= $currentID ?>" hidden>
                                <button type="submit" class="btn btn-success w-100">Extend</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            if (empty($activeVehicleList)) {
                echo '<div class="container-fluid">
                    <div class="row mt-5">
                        <div class="col-10 offset-1  pt-3 pb-3 text-center text-danger border">
                            <h5>No Vehicles Found!' . '<h5>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
