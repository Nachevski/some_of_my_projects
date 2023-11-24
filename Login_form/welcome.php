<?php
    session_start();
    $loginStatus = $_SESSION['loginStatus'] ?? false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <div class="background">
    </div>
    <div class="welcome-screen">
        <?php
            if ($loginStatus){
                $loggedUser = $_SESSION['loggedUser'];
                echo "<h1>Welcome, " . $loggedUser . "</h1>";
            }else{
                echo "<h1>You must Log in first!</h1>";
                echo "<h2>Redirecting to LogIn page in 5 sec... </h2>";
                header("REFRESH:5; URL=login.php");
            }
        ?>
    </div>
</body>
</html>