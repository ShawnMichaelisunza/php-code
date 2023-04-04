<?php

include('db_connect/connect.php');
session_start();

$username = $password = '';
$errors = array('username' => '', 'password' => '');

if(isset($_POST['sign-in'])){

    if(empty($_POST['username'])){

        $errors['username'] = 'Enter an username';

    }else{
        $username = $_POST['username'];

    }

    if(empty($_POST['password'])){

        $errors['password'] = 'Enter a password';

    }else{
        $password = $_POST['password'];
        if(strlen($password)<8){
            $errors['password'] = 'Password must be at least 8 characters long';
        }

        // sql 

        $sql ="SELECT * FROM register WHERE username='$username' AND password='$password'";
        $result =mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            header('Location: homepage.php');

        }else{
            $errors['password'] = "Invalid username or password";
        }
    }

}

if(isset($_POST['sign-up'])){

    header('Location:register.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="container">
        <h3 class="center green-text text-darken-4">Sign In</h3>
        <div class="login-form">
            <form action="login.php" method="POST">
                <label for="username">Username
                    <input type="text" name="username" placeholder="Username" value="">
                    <div class="red-text"><?php echo $errors['username']?></div>
                    <br>
                </label>
                <label for="password">Password
                    <input type="password" name="password" placeholder="Password" value="">
                    <div class="red-text"><?php echo $errors['password']?></div>
                </label>
                <div class="btn-1">
                <input type="submit" name="sign-in" value="Sign In">
                <input type="submit" name="sign-up" value="Sign Up">
                </div>
        </div>
            </form>
        </div>
    </body>
</html>