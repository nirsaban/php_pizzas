<?php 
require('config/connect.php');
$errors = ['email'=>'','title'=>'','ingredients'=>''];
$email = '';
$title = '';
$ingredients ='';
if(isset($_POST['submit'])){
if(empty($_POST['email'])){
    $errors['email'] = 'An email is required';
}else{
    $email = $_POST['email'];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] ='email must be a valid email address';
    }
    // echo htmlspecialchars($_POST['email']);
}
if(empty($_POST['title'])){
    $errors['title'] = 'An title is required';
}else{
    $title = $_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        $errors['title'] = 'title must a letter and spaces only';
    }
    // echo htmlspecialchars($_POST['title']);
}
if(empty($_POST['ingredients'])){
    $errors['ingredients'] = 'An ingredients is required';
}else{
     $ingredients = $_POST['ingredients'];
     if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['ingredients'] = 'ingredients must be a comma sepreated list';
     }
}
if(!array_filter($errors)){
$email = mysqli_real_escape_string($con,$_POST['email']);
$title = mysqli_real_escape_string($con,$_POST['title']);
$ingredients = mysqli_real_escape_string($con,$_POST['ingredients']);


$sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
if(mysqli_query($con,$sql)){
    header('Location:index.php');
}else{
    echo 'Query error '.mysqli_error($con);
}
   
}

}



?>
<!DOCTYPE html>
<html lang="en">
 <?php include('template/header.php')?>

<section class="container grey-text">
<h4 class="center">Add a pizza</h4>
<form action="<?= $_SERVER['PHP_SELF'] ?>" class="white" method="post">
<label for="">Your email</label>
<div class="red-text"><?= $errors['email']?></div>
<input type="text" name="email" value= "<?=htmlspecialchars($email)  ?>">
<label for="">Pizza Title</label>
<div class="red-text"><?= $errors['title']?></div>
<input type="text" name="title" value= "<?=htmlspecialchars($title)  ?>">
<label for="">Ingredients(comma separted):</label>
<div class="red-text"><?= $errors['ingredients']?></div>
<input type="text" name="ingredients" value= "<?=htmlspecialchars($ingredients)  ?>">
<div class="center">
<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
</div>
</form>
</section>
 <?php include('template/footer.php')?>
