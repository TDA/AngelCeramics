<?php
require_once('dbconn.php');

/*$name=$_POST['name'];
$modelno=$_POST['modelno'];
$size=$_POST['size'];
$type=$_POST['type'];

$make=$_POST['make'];
$colour=$_POST['colour'];
$date=$_POST['date'];
*/
foreach($_POST as $key => $value)
	if(!empty($_POST[$key])&&($key!='pstart')&&($key!='pend'))
		$post_copy[$key]="$key LIKE '%$_POST[$key]%'";

$qstring = implode(' AND ',$post_copy);

if(isset($_POST['pstart']) && isset($_POST['pend'] )){
$pstart=$_POST['pstart'];
$pend=$_POST['pend'];
$qstring.=" AND price > $pstart AND price < $pend";
}

//echo $qstring;

$query="select * from product_list where $qstring LIMIT 1";
//echo "<br>".$query;
$res=mysqli_query($dbconn,$query) or die('<br>error in query');
?>

<?php
if(mysqli_num_rows($res)!=0){
$row=mysqli_fetch_assoc($res);
			foreach($row as $key=>$value)
			{	
				$upperkey=strtoupper($key);
				if($upperkey!='IMG')
				echo "<tr><td class='$key'>$upperkey</td><td>$value</td></tr>";
			}
			echo ','.IMGPATH.$row['img'];
}
else
echo 21;
?>
