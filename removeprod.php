<?php
require_once('dbconn.php');
$id=$_POST['id'];
$query="delete from product_list where prod_id=$id LIMIT 1";
$res=mysqli_query($dbconn,$query) or die('0');
echo 1;

?>