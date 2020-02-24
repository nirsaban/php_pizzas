<?php
include('config/connect.php');
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($con,$_POST['item_to_delete ']);
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    if(mysqli_query($con,$sql)){
        header('Location:index.php');
    }else{
        echo 'Query erorr '.mysqli_error($con);
    }
}
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con,$_GET['id']);

    $sql = "SELECT * FROM pizzas WHERE id = $id";

    $result = mysqli_query($con,$sql);

    $pizza = mysqli_fetch_assoc($result);

}


?>
<!DOCTYPE html>
<html lang="en">
<?php include('template/header.php')?>
<div class="container center grey-text">
<?php if($pizza): ?>
<h4><?= htmlspecialchars($pizza['title']);?></h4>
<p>Created by : <?= htmlspecialchars($pizza['email'])?> </p>
<p><?= htmlspecialchars($pizza['created_at'])?></p>
<h5>Ingredients </h5>
<ul>
<?php foreach(explode(',',htmlspecialchars($pizza['ingredients'])) as $item):?>
<li><?= $item ?></li>
<?php endforeach; ?>
    </ul>
<p><?= htmlspecialchars($pizza['ingredients'])?> </p>
<form action="details.php" method="post">
<input type="hidden"  name="item_to_delete" value="<?=$pizza['id']?>"> 
<input type="submit" name="delete" value="Delete pizza" class="btn brand z-depth-0"> 
</form>
<?php else: ?>
<h5>No pizza exist </h5>
<?php endif; ?>
</div>

<?php include('template/footer.php')?>
</html>

   

