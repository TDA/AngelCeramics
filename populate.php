<?php
require_once('dbconn.php');
$modelno=$_POST['modelno'];
$query="select name,size,type,make,colour,date from product_list where modelno=$modelno LIMIT 1";
$res=mysqli_query($dbconn,$query) or die('<br>error in query1');
$row=mysqli_fetch_assoc($res);
if(mysqli_num_rows($res)==1){
foreach( $row as $key => $value)
{
	$stringarr[$key]="$key,$value"; 
}
$string=implode(',',$stringarr);

echo $string;
}
else
echo 21;
?>