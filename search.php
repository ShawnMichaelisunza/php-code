<?php

include('db_connect/connect.php');

// Search bar
$search = $_GET['search'];

// write query fro all pizzas
$sql = "SELECT l_name, f_name, m_name, email, contacts , id FROM add_info WHERE f_name 
LIKE '%$search%' or l_name LIKE '%$search%' ORDER BY time_stamp";

// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as array

$addInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);


?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="search" id="search">
            <button type="submit">Search</button>
        </form>
</div>
<section >
<h1 style="font-size: 50px; margin:30px auto; color: #043104; text-align:center;">Add List</h1>
<div class="boxes">
    <div class="cards">
    <?php foreach($addInfo as $info){ ?>
        
        <table class="card" >
            <tr class="img-1">
                <th><img src="images/blank.PNG" style="width: 50%; border-radius: 50%; margin-top: 10px;" alt=""></th>
            </tr>
            <tr>
                <td><i class="fas fa-user-alt"></i>&nbsp;<span><?php echo $info['l_name']." ".$info['f_name']; ?><span></td>
            </tr>
            <tr>
            <td class="more-info"><a href="details.php?id=<?php echo $info['id'];?>">More info</a></td>
            </tr>
        </table>
    <?php }?>

    </div>
</div>
</section>


<?php include('templates/footer.php') ?>
</html>