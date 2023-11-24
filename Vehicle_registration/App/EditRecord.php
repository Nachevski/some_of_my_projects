<?php
require_once('./require_all.php');

isAdminLogged();

if (checkIfPOST() && isset($_POST['id'])) {
    $_SESSION['tempObject'] = findObject($_POST['id']);
    $objectData = $_SESSION['tempObject'][1];
    $_SESSION['tempRecordID'] = $_POST['id'];
} elseif (isset($_SESSION['tempRecordID'])) {
    $objectData = $_SESSION['tempObject'][1];
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
            <div class="col- bg-danger p-3 text-light text-center">
                <h4>' . $_SESSION['error'] . '</h4>
            </div>
        </div>
      </div>';
    $_SESSION['error'] = null;
}
//if (isset($_SESSION['success'])) {
//    echo '<div class="container-fluid">
//            <div class="row">
//                <div class="col-10 offset-1 bg-success p-3 text-light text-center">
//                    <h4>' . $_SESSION['success'] . '</h4>
//                </div>
//            </div>
//          </div>';
//    $_SESSION['success'] = null;
//}
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-8 offset-2 p-5 text-center bg-secondary-subtle">
            <h1>Edit Record</h1>
            <form action="Processing/savingEditedRecord.php" method="POST" class="text-start">
                <div class="row">
                    <div class="col-6 mt-3">
                        <div class="mb-3">
                            <label for="vehicleModel" class="form-label">Vehicle Model</label>
                            <select class="form-select" name="vehicleModel" id="vehicleModel">
                                <?php
                                echo '<option value="' . $objectData->getVehicleModelID() . '"selected>' . $objectData->getVehicleModel() . '</option>';
                                foreach ($_SESSION['VehicleModel'] as $vehicle) {
                                    if ($vehicle->getVehicleModel() == $objectData->getVehicleModel()) continue;
                                    echo '<option value="' . $vehicle->getVehicleModelID() . '">' . $vehicle->getVehicleModel() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class=" mb-3
                                ">
                            <label for="vehicleVIN" class="form-label">Vehicle VIN Number</label>
                            <input type="text" class="form-control" id="vehicleVIN"
                                   name="vehicleVIN" placeholder="Vehicle VIN Number"
                                   value="<?= $objectData->getVehicleVIN() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="registrationNumber" class="form-label">Registration Number</label>
                            <input type="text" class="form-control" id="registrationNumber"
                                   name="registrationNumber" placeholder="Vehicle Registration Number"
                                   value="<?= $objectData->getRegistrationNumber() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="registrationDate" class="form-label">Registration To</label>
                            <input type="text" class="form-control" id="registrationDate"
                                   name="registrationDate" placeholder="mm/dd/yyyy" pattern="\d{2}/\d{2}/\d{4}"
                                   value="<?= $objectData->getRegistrationDate() ?>">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="mb-3">
                            <label for="vehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-select" name="vehicleType" id="vehicleType">
                                <?php
                                echo '<option value="' . $objectData->getVehicleTypeID() . '" selected>' . $objectData->getVehicleType() . '</option>';
                                foreach ($_SESSION['VehicleTypes'] as $vehicle) {
                                    if ($vehicle->getVehicleType() == $objectData->getVehicleType()) continue;
                                    echo '<option value="' . $vehicle->getVehicleTypeID() . '">' . $vehicle->getVehicleType() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productionYear" class="form-label">Vehicle Production Year</label>
                            <input type="text" class="form-control" id="productionYear"
                                   name="productionYear" placeholder="yyyy" pattern="\d{4}"
                                   value="<?= $objectData->getProductionYear() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vehicleFuelType" class="form-label">Fuel Type</label>
                            <select class="form-select" name="vehicleFuelType" id="vehicleFuelType">
                                <?php
                                echo '<option value="' . $objectData->getVehicleFuelTypeID() . '">' . $objectData->getVehicleFuelType() . '</option>';
                                foreach ($_SESSION['VehicleFuelTypes'] as $vehicle) {
                                    if ($vehicle->getVehicleFuelType() == $objectData->getVehicleFuelType()) continue;
                                    echo '<option value="' . $vehicle->getVehicleFuelTypeID() . '">' . $vehicle->getVehicleFuelType() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input name="recordID" value="<?= $_SESSION['tempRecordID'] ?>" hidden>
                        <button type="submit" class="btn btn-success w-100 mt-4" style="width: 49% !important;">Save
                        </button>
                        <a href="Dashboard.php" class="btn btn-primary w-100 mt-4"
                           style="width: 49% !important;">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
