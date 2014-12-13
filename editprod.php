<?php
require_once('dbconn.php');

$name=$_POST['name'];
$modelno=$_POST['modelno'];
$size=$_POST['size'];
$type=$_POST['type'];
$qty=$_POST['stock'];
$pcs=$_POST['pcs'];
$make=$_POST['make'];
$colour=$_POST['colour'];
$date=$_POST['date'];
$img=$_FILES['img']['name'];
$price=$_POST['price'];
$prod_id=$_POST['pid'];
echo $prod_id;
$no_res=25;
$num=ceil($prod_id/$no_res);

move_uploaded_file($_FILES['img']['tmp_name'],IMGPATH.$img);

$insert_array=compact("name","modelno","size","type","qty","pcs","make","colour","date","price","img");

$qstring='';
foreach($insert_array as $key => $value) {
//    echo "$key - $value <br />";
	if($key!='img')
	$qstring.="$key='$value',";
	else
	$qstring.="$key='$value'";
}
//echo $qstring;

$updatequery="update product_list set $qstring where prod_id=$prod_id";
//echo $updatequery;
		$res=mysqli_query($dbconn,$updatequery) or die('21');
		//echo 2;



	echo 'Success';
	
header("location:dbedit.php?action=edit&num=$num");
	
?>

