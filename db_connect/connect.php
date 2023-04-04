<?php

// connect database

$conn = mysqli_connect('localhost','shawn','12312345','login_register');



if(!$conn){
    echo 'connection error:' . mysqli_connect_error();
}

?>