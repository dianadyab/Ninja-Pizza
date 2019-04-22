
<?php
//check if the form has been submited
if (isset($_POST['submit'])) {
  // email, title , ingredients are required
  if(empty($_POST['email'])){
    echo "Email  is required</br>";
  }
  else{
    //validate that the email is required
    //use email filter , built in in php
    $email=$_POST["email"];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      //if not email syntax
      echo "email must be a valid email address";
    }
  }
  if(empty($_POST['title'])){
    echo "Tiltle  is required</br>";
  }
  if(empty($_POST['ingRedients'])){
    echo "Ingredients  is required</br>";
  }
}





?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include('templates/header.php'); ?>

<section class="container" style="width:50%;">
<h4 style="text-align:center;color:darkorange">Add a Pizza</h4>
<form  action="add.php" method="POST" style="background-color:white;padding:20px;">
<div class="form-group">
 <label >Your Email:</label>
 <input type="text" name="email" class="form-control" value="">

</div>
<div class="form-group">
 <label >Pizza title:</label>
 <input type="text" name="title" class="form-control" value="">

</div>

<div class="form-group">

 <label >Ingredients:</label>
 <input type="text" name="ingredients"  class="form-control" value="">

</div>
<div style="width: 15%;
 margin: 10px auto;" >
 <input type="submit" name="submit" value="submit" style="background: darkorange;color:white;border:none;font-size:large;">
</div>
</form>
</section>


<?php include('templates/footer.php'); ?>

</html>
