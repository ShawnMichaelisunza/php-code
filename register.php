<?php

include('db_connect/connect.php');

$username = $password = $confirmPass = $email = '';
$errors = array('username' => '', 'password' => '', 'Confirm-password' => '', 'email' => '');

if(isset($_POST['sign-up'])){

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
    }
    if(empty($_POST['Confirm-password'])){

        $errors['Confirm-password'] = 'Enter a password';

    }else{
        $confirmPass = $_POST['Confirm-password'];
        if($password !== $confirmPass){
            $errors['Confirm-password'] = 'Password does not match';
        }
    }
    if(empty($_POST['email'])){
        $errors['email'] = 'Enter an email address';
    }
    else{
        $email = $_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email is not valid';
        }
        // sql
        
        $sql = "INSERT INTO register(username, password, email) VALUES ('$username', '$password','$email')";
        $result = mysqli_query($conn, $sql);
        if($result){
        header('Location: login.php');
        }else{
        echo "Registration Failed";
        }
    }

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
        <h3 class="center green-text text-darken-4">Sign Up</h3>
        <div class="login-form">
            <form action="register.php" method="POST">
                <label for="username">Username
                    <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                    <div class="red-text"><?php echo $errors['username'];?></div>
                </label>
                <label for="password">Password
                    <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">.
                    <div class="red-text"><?php echo $errors['password'];?></div>
                </label>
                <label for="password">Confirm Password
                    <input type="password" name="Confirm-password" placeholder="Confirm password" value="<?php echo htmlspecialchars($confirmPass); ?>">
                    <div class="red-text"><?php echo $errors['Confirm-password'];?></div>
                </label>
                <label for="email">Email
                    <input type="email" name="email" placeholder="email" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="red-text"><?php echo $errors['email'];?></div>
                </label>
                <div class="btn-1">
                <input type="submit" name="sign-up" value="Sign Up">
                </div>

                <p class="center">Already have an account <a href="login.php" class="red-text"><u>Sign In</u></a></p>
        </div>
            </form>

        </div>
    </body>
</html>