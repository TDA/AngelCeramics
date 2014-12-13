<?php
require_once('dbconn.php');

$word=$_POST['word'];
$field=$_POST['field'];

$q1="select * from product_list where $field LIKE '%$word%'";
$res=mysqli_query($dbconn,$q1) or die("query error");
$string_array;
$string='';
if(mysqli_num_rows($res)>1){
while($row=mysqli_fetch_assoc($res))
{
	$string_array[]=trim($row[$field]);
}
$string=implode($string_array,',');
echo trim($string);
}
else if(mysqli_num_rows($res)==1)
{
	$row=mysqli_fetch_assoc($res);
	$string=trim($row[$field]);
	echo $string;
}
else
echo "No matches found";
?>
	
