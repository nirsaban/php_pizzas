<?php 
//connect to DB
require('config/connect.php');
//write query for all pizza 
$sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
$result = mysqli_query($con,$sql);
//fetch the result from db to array assoc
$pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
 <?php include('template/header.php')?>
 <h4 class="center grey-text">Pizzas</h4>
 <div class="container">

 <div class="row">
 <?php foreach($pizzas as $pizza): ?>
<div class="col s6 md3">
<div class="card z-depth-0">
<img src="img/pizza.svg" class="pizza" alt="">
<div class="card-content center">
<h6><?= htmlspecialchars($pizza['title']); ?></h6>

<ul>
<?php foreach(explode(',',$pizza['ingredients']) as $item): ?>
<li><?= $item ?></li>
<?php endforeach ?>
</ul>
</div>
<div class="card-action right-align">
<a href="details.php?id=<?=$pizza['id']; ?>" class="brand-text">More info</a>

</div>
</div>

</div>


<?php endforeach ;?>
 </div>
 
 </div>
 <?php include('template/footer.php')?>
