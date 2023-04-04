<?php

include('db_connect/connect.php');

// get page number
if(isset($_GET['page_no']) && $_GET['page_no'] !==""){
    $page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}

// total rows or records to display

$total_records_per_page = 12;

// get the page offset for the LIMIT query

$offset = ($page_no -1) * $total_records_per_page;

// get previous page
$previous_page = $page_no -1;
// get next page 
$next_page = $page_no + 1;


// get the total count of records
$result_count = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM login_register.add_info")
 or die(mysqli_error($conn));

//  total records
$records = mysqli_fetch_array($result_count);
// store total_records to a variable

$total_records = $records['total_records'];

// get total pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// write query fro all pizzas

$sql = "SELECT l_name, f_name, m_name, email, contacts , id FROM add_info ORDER BY create_at LIMIT 
$offset , $total_records_per_page";

// make query & get result
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

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
<section >
    <div class="search-bar">
            <form action="search.php" method="GET">
                <input type="text" name="search" id="search">
                <button type="submit">Search</button>
            </form>
    </div>
<h1 style="font-size: 50px; margin:80px auto 10px auto; color: #043104; text-align:center; display: flex;">Add List</h1>
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
    <nav class="page_bar">
    <ul>
        <li><a class=" <?=($page_no <= 1)? 'disabled' : '';?>"
        <?= ($page_no > 1)? 'href=?page_no=' . $previous_page : '';?>>Previous</a></li>

        
        <?php for($counter =1; $counter <= $total_no_of_pages; $counter++){?>
            <?php if($page_no != $counter){?>
        <li><a href="?page_no=<?= $counter?>"><?= $counter?></a></li>
            <?php } else {?>
            <li><a><?= $counter?></a></li>
            <?php }?>
        <?php }?>


        <li><a class=" <?=($page_no >= $total_no_of_pages)? 'disabled' : '';?>"
        <?= ($page_no < $total_no_of_pages)? 'href=?page_no=' . $next_page : '';?>>Next</a></li>
    </ul>
    <div class="display-page">
    <strong>Page <?= $page_no;?> of <?= $total_no_of_pages;?></strong>
    </div>
</nav>
</div>
</section>


<?php include('templates/footer.php') ?>
</html>