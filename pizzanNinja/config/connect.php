<?php
$con = mysqli_connect('localhost','root','','pizzaninja');
if(!$con){
echo 'Connection Error =>'.mysqli_connect_error();
}
?>