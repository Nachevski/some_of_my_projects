<?php
   include("./config/database.php"); 

    $query_Insert = "INSERT INTO clients (full_name, company_name, email, phone, academies_id ) VALUES ('" . $_POST['fullname'] . "', '" . $_POST['companyName'] . "', '" . $_POST['email'] . "', " . $_POST['phone'] . ", " . $_POST['academy-type'] . ");";
    insert_data($db, $query_Insert);
    // echo $query_Insert ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <!-- PAGE ICON  -->
    <link rel="icon" href="./imgs/Brainster/favicon.png" />
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="./css/main.css" />

</head>
<body>
    
<div class="postMessage">
      <div class="form-bg">
        <div class="form-body">
          <div class="form-message">
            <h3>Ви благодариме што избравте наш студент!</h3>
            <a href="index.html" class="btn">Вртати се назад</a>
          </div>
        </div>
      </div>
    </div>

    <script src="./script/post.js"></script>
</body>
</html>