<?php
    declare(strict_types=1);
    define("specialChars", ' @$%^&*_+-=|\/()[]{};:",<>?~#');

    function getAllUsers(){
        $temp = explode(PHP_EOL, file_get_contents("register.txt", ));
        $users =[];
        foreach($temp as $user){
            if($user != ""){
                $userExplode = explode(',', $user);
                $userCredentials = explode('=', $userExplode[1]);   
                $tempData ['email'] = $userExplode[0];
                $tempData ['username'] = $userCredentials[0];
                $tempData ['password'] = $userCredentials[1];
                $users[] = $tempData;
            }
        }
        return $users;
    }

    function isEmptyInput(string $username, string $email, string $password) {
        $errorMSG = "This field is required!";
        if ($username == ""){
            $validationReport['usernameIsEmpty'] = $errorMSG;
        }
        if ($email == ""){
            $validationReport['emailIsEmpty'] = $errorMSG;
        }
        if ($password == ""){
            $validationReport['passwordIsEmpty'] = $errorMSG;
        }
        if(isset($validationReport)){
            return $validationReport;
        }
    }

    function isUsernameExists(string $username, array $users): bool{
        foreach ($users as $user){
            if ($user['username'] === $username){
                return true;
            }
        }
        return false;
    }

    function usernameValidation(string $username): bool{
        $usernameChars = str_split($username);
        foreach ($usernameChars as $char){
            if ($char == " " || strpos(specialChars, $char)){
                return false;
            }
        }
        return true;
    }

    function isEmailExists(string $email, array $users): bool{
        foreach ($users as $user){
            if ($user['email'] === $email){
                return true;
            }
        }
        return false;
    }

    function emailValidation(string $email): bool{
        $emailSplit = explode("@", $email, -1);
        if (strlen($emailSplit[0] ?? '') < 5){
            return false;
        }
        return true;
    }

    function validatePassword($password): bool {
        $passwordChars = str_split($password);
        $upperChar = $specChar = $number = 0;
        foreach($passwordChars as $char){
            if (ctype_upper($char)){
                $upperChar++;
            }
            if (is_numeric($char)){
                $number++;
            }
            if (strpos(specialChars, $char)){
                $specChar++;
            }
            if ($specChar >= 1 && $number >= 1 && $upperChar >= 1 ){
                return false;
            }
        }
        return true;
    }

    function validateAll(string $username, string $email, string $password): mixed {
        $users = getAllUsers();
        $validationReport = isEmptyInput($username, $email, $password);
        if (!empty($users)){
            if (isUsernameExists($username, $users)){
                $validationReport['usernameExists'] = "Username is taken!";
            };
            if (isEmailExists($email, $users)){
                $validationReport['emailExists'] = "A user
                with this email already exists!";
            };
        }

        if (!usernameValidation($username)){
            $validationReport['usernameValidationFail'] = "Username cannot contains empty space or special char";
        }
        if (!emailValidation($email) && !isset($validationReport['emailIsEmpty'])){
            $validationReport['emailValidationFail'] = "Email must have 5 chars before @";
        }
        
        if (validatePassword($password) && !isset($validationReport['passwordIsEmpty'])){
            $validationReport['passwordValidationFail'] = "Password must have number, upper char and special char";
        }
        return $validationReport ?? '';
    }

    function loginSuccesfull($loggedUser){
        session_start();
        $_SESSION['loggedUser'] = $loggedUser;
        $_SESSION['loginStatus'] = true;
        header("LOCATION:welcome.php");
    }
?>