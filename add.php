
<?php
include('config/db.php');
//store the errors in variable
$errors=['email'=>'','title'=>'', 'ingredients'=>''];
$email=$title=$ingredients='';
//check if the form has been submited
if (isset($_POST['submit'])) {
  // email, title , ingredients are required
  if(empty($_POST['email'])){
    $errors['email']= "Email  is required</br>";
  //  echo $errors['email'];
  }
  else{
    //validate that the email is required
    //use email filter , built in in php
    $email=$_POST["email"];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      //if not email syntax
    $errors['title']= "email must be a valid email address";
    }
  }

  if(empty($_POST['title'])){
    $errors['title']= "Tiltle  is required</br>";
  }
  else{
    //if title not empty check if the title is validate
    //use reguler expression
    $title=$_POST["title"];
    if(!preg_match('/^[a-zA-z\s]+$/',$title)){

    $errors['title']= "Title must be letters and spaces only</br>";
    }
  }
  if(empty($_POST['ingredients'])){
    $errors['ingredients']="Ingredients  is required</br>";
  }
  else{
    //if title not empty check if the title is validate
    //use reguler expression
    $ingredients=$_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){

    $errors['ingredients']= "Ingredients must be letters and spaces only</br>";
    }
  }
  //if there is no error in the form redirect the user to main page "index.php"
  //array_filter($errors), if there no errprs return false

if(!array_filter($errors)){
  // save the data in database email,title,Ingredients
  //escape variable for security
$email=mysqli_real_escape_string($conn,$_POST['email']);
$title=mysqli_real_escape_string($conn,$_POST['title']);
$ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

// create sql
$sql="INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
//save to db
if(mysqli_query($conn,$sql)){
  //success then redirect user to index page
  header('Location:index.php');//redirect user to main page
}
else{
  //error
  echo 'query error:'. mysqli_error($conn);
}

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
 <input type="text" name="email" class="form-control" value="<?php echo $email ?>">
 <div class=""style="color:red;">
 <?php echo $errors['email']; ?>
 </div>
</div>
<div class="form-group">
 <label >Pizza title:</label>
 <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
<div class=""style="color:red;">
<?php echo $errors['title']; ?>
</div>
</div>

<div class="form-group">

 <label >Ingredients:</label>
 <input type="text" name="ingredients"  class="form-control" value="<?php echo $ingredients ?>">
 <div class=""style="color:red;">
 <?php echo $errors['ingredients']; ?>
 </div>
</div>
<div style="width: 15%;
 margin: 10px auto;" >
 <input type="submit" name="submit" value="submit" style="background: darkorange;color:white;border:none;font-size:large;">
</div>
</form>
</section>


<?php include('templates/footer.php'); ?>

</html>
