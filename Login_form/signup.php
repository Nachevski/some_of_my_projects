<?php
    include_once('validation.php');
    $errorTemplate = "<p class='errorValidation %s'>%s <i class='fa-solid fa-square-xmark'></i></p>";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        $validationReport = validateAll($username, $email, $password);

        if (empty($validationReport)){
            registerNewUser($username, $email, $password);
        }
    }

    function registerNewUser($username, $email, $password){
        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents("register.txt", $email . ',' .$username."=".$encryptedPassword.PHP_EOL, FILE_APPEND);
        loginSuccesfull($username);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="background">
        <?php echo "<h1 class='main-header'>Sign Up Form</h1>" ?>
    </div>
    <div class="welcome-screen">
        <div class="signup">
            <form action="" method="POST">
                <?php

                // USERNAME
                if (isset($validationReport['usernameIsEmpty'])){
                    printf($errorTemplate,'Username',$validationReport['usernameIsEmpty']);
                    echo '<input type="text" name="username" placeholder="Enter your username" class="borderError" id="loginUsername" autofocus>';
                }elseif (isset($validationReport['usernameExists'])){
                    printf($errorTemplate,'Username',$validationReport['usernameExists']);
                    echo '<input type="text" name="username" placeholder="Enter your username" class="borderError" id="loginUsername" autofocus>';
                }elseif (isset($validationReport['usernameValidationFail'])){
                    printf($errorTemplate,'Username',$validationReport['usernameValidationFail']);
                    echo '<input type="text" name="username" placeholder="Enter your username" class="borderError" id="loginUsername" autofocus>';
                }else{
                    echo '<input type="text" name="username" placeholder="Enter your username" id="loginUsername" autofocus>';
                }

                // EMAIL
                if (isset($validationReport['emailIsEmpty'])){
                    printf($errorTemplate,'Email',$validationReport['emailIsEmpty']);
                    echo '<input type="email" name="email" placeholder="Enter your email" class="borderError" id="loginEmail">';
                }elseif (isset($validationReport['emailExists'])){
                    printf($errorTemplate,'color-yellow Email', $validationReport['emailExists']);
                    echo '<input type="email" name="email" placeholder="Enter your email" class="borderError" id="loginEmail">';
                }elseif (isset($validationReport['emailValidationFail'])) {
                    printf($errorTemplate,'Email',$validationReport['emailValidationFail']);
                    echo '<input type="email" name="email" placeholder="Enter your username" class="borderError" id="loginEmail">';
                }else{
                    echo '<input type="email" name="email" placeholder="Enter your email" id="loginEmail">';
                }

                // PSSWORD
                if (isset($validationReport['passwordIsEmpty'])){
                    printf($errorTemplate,'Password',$validationReport['passwordIsEmpty']);
                    echo '<input type="password" name="password" placeholder="Enter your password" class="borderError" id="loginPassword">';
                }elseif (isset($validationReport['passwordValidationFail'])) {
                    printf($errorTemplate,'Password',$validationReport['passwordValidationFail']);
                    echo '<input type="password" name="password" placeholder="Enter your password" class="borderError" id="loginPassword">';
                }else{
                    echo '<input type="password" name="password" placeholder="Enter your password" id="loginPassword">';
                }

                ?>
                <button type="submit" class="btn">Sign Up</button>
            </form>
        </div>
    </div>
    <script src="./script/script.js"></script>
</body>
</html>