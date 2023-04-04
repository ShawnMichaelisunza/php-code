<?php

include('db_connect/connect.php');
include('db_connect/processing.php');

$lastname = $firstname = $middlename = $email = $contact = '';
$errors = array('last-name' => '', 'first-name' => '', 'middle-name' => '', 'email' => '','contact' => '');
if(isset($_POST['submit'])){
    
    $lastname = $_POST['last-name'];
    $firstname = $_POST['first-name'];
    $middlename = $_POST['middle-name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    if(empty($_POST['first-name'])){
        $errors['first-name'] = '*Enter your first Name';
    }else{

        if(!preg_match('/^[a-zA-Z\s]+$/',$firstname)){
            $errors['first-name'] = '*Letters only';
        }
    }
    if(empty($_POST['last-name'])){
        $errors['last-name'] = '*Enter a last Name';
    }else{

        if(!preg_match('/^[a-zA-Z\s]+$/',$lastname)){
            $errors['last-name'] = '*Letters only';
        }
    }
    if(empty($_POST['middle-name'])){
        $errors['middle-name'] = '*Enter a middle Name';
    }else{

        if(!preg_match('/^[a-zA-Z\s]+$/',$middlename)){
            $errors['middle-name'] = '*Letters only';
        }
    }

    if(empty($_POST['email'])){
        $errors['email'] = '*Enter an email';
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = '*email must be a valid email address';
        }
    }

    if(empty($_POST['contact'])){

        $errors['contact'] = '*Enter a contact number';
    }
    else{
        if(!preg_match('/^[a-zA-Z\s]+$/',$middlename)){
            $errors['middle-name'] = '*numbers only';
        }
    }


    if(array_filter($errors)){
        // errors in the form
    }else{


        $firstname = mysqli_real_escape_string($conn, $_POST['first-name']);
        $lastname  = mysqli_real_escape_string($conn, $_POST['last-name']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middle-name']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        // create   sql

        $sql ="INSERT INTO add_info(l_name, f_name, m_name, email, contacts) VALUES('$lastname', '$firstname', '$middlename', '$contact', '$email')";

        if(mysqli_query($conn, $sql)){
            //success
        }
        else
        {
            echo 'query error: ' . mysqli_error($conn);
        }

        header('Location:homepage.php');

    }
}

?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<section class="container">
    <h1 style="font-size: 50px; margin:30px auto; color: #043104;">Add Info</h1>
    <form action="add.php" method="POST" class="form-1" enctype="multipart/form-data">
        <label for="">Last Name</label>
        <input type="text" name="last-name" value="<?php htmlspecialchars($lastname)?>">
        <div style="margin: 3px 20%; color: red;"><?php echo $errors['last-name']; ?></div>
        <label for="">First Name</label>
        <input type="text" name="first-name" value="<?php htmlspecialchars($firstname)?>">
        <div style="margin: 3px 20%; color: red;"><?php echo $errors['first-name']; ?></div>
        <label for="">Middle Name</label>
        <input type="text" name="middle-name" value="<?php htmlspecialchars($middlename)?>">
        <div style="margin: 3px 20%; color: red;"><?php echo $errors['middle-name']; ?></div>
        <label for="">Email</label>
        <input type="email" name="email" value="<?php htmlspecialchars($email)?>">
        <div style="margin: 3px 20%; color: red;"><?php echo $errors['email']; ?></div>
        <label for="">Contact No.</label>
        <input type="number" name="contact" value="<?php htmlspecialchars($contact)?>">
        <div style="margin: 3px 20%; color: red;"><?php echo $errors['contact']; ?></div>
        <label for="">Picture</label>
        <input type="file" name="picture" value="" id="picture">
        <div class="btn-1">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</section>
<?php include('templates/footer.php') ?>
</html>