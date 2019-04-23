<?php
//include connection to database
include('config/db.php');

//check GET request id parameter

if(isset($_GET['id'])){
//get the record from the database where the id is equal to $_GET['id'];
//for security
$id = mysqli_real_escape_string($conn,$_GET['id']);
//make sql
$sql ="SELECT * FROM pizzas WHERE id=$id";
//get the query results
$result=mysqli_query($conn,$sql);
//fetch the results in array format(Associative array)
$pizza=mysqli_fetch_assoc($result);
//FREE RESULT FROM MEMORY
mysqli_free_result($result);
//CLOSE CONNECTION WITH DB
mysqli_close($conn);
//print_r($pizza);

}
//check if the form delete is submitted
if (isset($_POST['delete'])) {
  //delete the record with that id
$id_to_delete=mysqli_real_escape_string($conn,$_POST['id']);
$sql="DELETE FROM pizzas WHERE id=$id_to_delete";
//make query
if(mysqli_query($conn,$sql)){
  //success in creating query
  //redirect to index.php page
header('Location:index.php');
}else{
  //fail
  echo "query error: ".mysqli_error($conn);
}


}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
  <?php include('templates/header.php'); ?>
<h4 style="color:darkorange;text-align:center;">DETAILS!</h4>
<div class="container" style="text-align:center">
  <h4><?php echo $pizza['title'] ?></h4>
  <p>created by : <?php echo $pizza['email']; ?></p>
  <p>created at : <?php echo date($pizza['created_at']); ?></p>
  <h5>ingredients:</h5>
  <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>
<form class="" action="details.php" method="post">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <input type="submit" name="delete" value="Delete" class="btn btn-danger">
</form>
</div>

  <?php include('templates/footer.php') ?>
 </html>
