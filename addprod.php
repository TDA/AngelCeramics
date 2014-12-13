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
$price=$_POST['price'];
$img=$_FILES['img']['name'];
$no_res=25;
move_uploaded_file($_FILES['img']['tmp_name'],IMGPATH.$img);

$insert_array=compact("name","modelno","size","type","qty","pcs","make","colour","date","price","img");
@$prod_id=$_POST['id'];
$qstring='';
foreach($insert_array as $key => $value) {
//    echo "$key - $value <br />";
	
	if($key!='img')
	$qstring.='\''.trim($value).'\',';
	else
	$qstring.='\''.trim($value).'\'';
	
}
//echo $qstring;

	$q1="select * from 	product_list where modelno='$modelno'";
	$res=mysqli_query($dbconn,$q1) or die("query error");
	if(mysqli_num_rows($res)!=0)
	{
	//echo 'Duplicate entry,please go back and try different values <a href="dbedit.php?action=add">here</a>';
	//die();
	$row=mysqli_fetch_assoc($res);
	$id=$row['prod_id'];
	$page=ceil($id/$no_res);
	header("location:dbedit.php?action=edit&num=$page&name=$name&mn=$modelno&q=$qty&p=$pcs&c=$colour&pr=$price&s=$size");
	}
	else{		
	$query="insert into product_list values ('',$qstring)";
	$res=mysqli_query($dbconn,$query) or die('query gone');
	echo 'Success';
	header('location:dbedit.php?action=add&msg=success');
	}

	
?>

