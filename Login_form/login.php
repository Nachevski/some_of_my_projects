<?php
    include_once('validation.php');
    $errorTemplate = "<p class='errorValidation%s'>%s <i class='fa-solid fa-square-xmark'></i></p>";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginRequest = userLogin($username, $password);
        $validationReport = isEmptyInput($username, " ", $password);
        }

        // Administrator=@dMin666
        
        function userLogin(string $username, string $password){
            $users = getAllUsers();
            foreach ($users as $user){
                if (($user['username'] === $username || $user['email'] === $username) && password_verify($password, $user['password'])){
                    loginSuccesfull($user['username']);
                }
            }
            return false;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="background">
        <?php echo "<h1 class='main-header'>Log In Form</h1>"?>
    </div>
    <div class="welcome-screen">
        <div class="login">
            <form action="" method="POST">
                <?php 
                if (isset($validationReport['usernameIsEmpty']) && isset($validationReport['passwordIsEmpty'])){
                    printf($errorTemplate," Username",$validationReport['usernameIsEmpty']);
                    echo '<input type="text" name="username" placeholder="Enter your username or email" class="borderError" id="loginUsername" autofocus>';
                    printf($errorTemplate," Password", $validationReport['passwordIsEmpty']);
                    echo '<input type="password" name="password" placeholder="Enter your password" class="borderError" id="loginPassword">';
                }elseif (isset($loginRequest)) {
                    printf($errorTemplate,"Login Username Password", 'Wrong username/password combination! '); 
                    echo '<input type="text" name="username" placeholder="Enter your username or email" class="borderError" id="loginUsername" autofocus>';
                    echo '<input type="password" name="password" placeholder="Enter your password" class="borderError" id="loginPassword">';
                }else{
                    echo '<input type="text" name="username" placeholder="Enter your username or email" autofocus>';
                    echo '<input type="password" name="password" placeholder="Enter your password">';
                }
                ?>
                <button type="submit" class="btn" >Log In</button>
            </form>
        </div>
    </div>
    <script src="./script/script.js"></script>

</body>
</html>
