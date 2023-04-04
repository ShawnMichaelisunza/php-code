<?php

include('db_connect/connect.php');


if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql ="DELETE FROM add_info WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        header('Location: homepage.php');
    }else{
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
}

if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql ="SELECT * FROM add_info WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $info = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    mysqli_close($conn);

}


?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>
<section>
<h1 style="font-size: 50px; margin:30px auto; color: #043104; text-align:center;">Details</h1>
<div class="details">
<?php if($info): ?>
    <div class="d-img">
    <img src="" alt="">
    </div>
    <ul>
    <li>ID NO: <a><?php echo htmlspecialchars($info['id']);?></a></li>
    <li>Last Name: <a><?php echo htmlspecialchars($info['l_name']);?></a></li>
    <li>First Name: <a><?php echo htmlspecialchars($info['f_name']);?></a></li>
    <li>Middle Name: <a><?php echo htmlspecialchars($info['m_name']);?></a></li>
    <li>Email Address: <a><?php echo htmlspecialchars($info['email']);?></a></li>
    <li>Contact No: <a><?php echo htmlspecialchars($info['contacts']);?></a></li>
    <li>Date & Time: <a><?php echo htmlspecialchars($info['create_at']);?></a></li>
    </ul>

    <!-- DELETE FORM-->
    <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $info['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn-delete">
    </form>
    <?php else:?>
    <?php endif;?>
</div>

</section>
<?php include('templates/footer.php') ?>
</html>