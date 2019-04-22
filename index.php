<?php
$ings=[];
//retrieve all records from pizzas table and show them in this page

//connect to the database
//mysqli or PDP(PHP Data Objects) to connect to data base
//mysqli
//connection reference
$conn = mysqli_connect('localhost','Diana','data12345','ninja_pizza');
//check the connection
if(!$conn){
echo "connection error".mysqli_connection_error();
}
//retrieve data from database
// 1. send query 2. make query 3. fetch data
//write query for all pizzas
$sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
 //make the query and get the result(not usable format)

$result=mysqli_query($conn,$sql);

//fetch the resulting rows as an array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);//return data as an associative array
//free the result from memory
mysqli_free_result($result);
//close connection to data base
mysqli_close($conn);
//print_r($pizzas);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include('templates/header.php'); ?>
<!--output $pizzas to template  -->
<h1 style="text-align:center;margin:20px;color:darkorange">Pizzas!</h1>
<div class="container" >

  <div class="row" >
    <?php foreach ($pizzas as $pizza) :?>
<div class="col-md-6 " >
  <div class="card" style="text-align:center;background:white;">
    <h4 style="padding-top:10px;"><?php echo $pizza['title'] ?></h4>
    <div class="" style="padding-bottom:10px;height:100px;">
      <?php $ings=explode(',',$pizza['ingredients']) ?>
      <ul style="list-style-type:none;">
        <?php foreach ($ings as $i){ ?>
          <li><?php echo $i; ?></li>
        <?php }?>
      </ul>
    </div>
    <div class="" style="text-align:right;padding:10px;border-top:1px solid #ff8c0036 ;">
      <a style="text-decoration:none;color:darkorange;" href="#">MORE INFO</a>
    </div>
  </div>
</div>
<?php endforeach; ?>
  </div>
</div>


<?php include('templates/footer.php'); ?>

</html>
