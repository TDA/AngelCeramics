<?php
require_once('dbconn.php');
/*$name=$_POST['name'];
$modelno=$_POST['modelno'];
$size=$_POST['size'];
$type=$_POST['type'];
$make=$_POST['make'];
$colour=$_POST['colour'];
$date=$_POST['date'];*/

$num=isset($_GET['num'])?$_GET['num']:1;
$no_res=25;
$num=($num-1)*$no_res;

foreach($_POST as $key => $value)
	if(!empty($_POST[$key])&&($key!='pstart')&&($key!='pend')&&($key!='from')&&($key!='to'))
		$post_copy[$key]="$key LIKE '%$_POST[$key]%'";

$qstring = implode(' AND ',$post_copy);

if(isset($_POST['pstart']) && isset($_POST['pend'] )){
$pstart=$_POST['pstart'];
$pend=$_POST['pend'];
$qstring.=" AND price > $pstart AND price < $pend";
}


//echo $qstring;

$query="select * from product_list where $qstring";
$res=mysqli_query($dbconn,$query) or die('<br>error in query1');
$no_rows=mysqli_num_rows($res);

if($no_rows!=0){
$no_pages=ceil($no_rows/$no_res);
$query_one_page="select * from product_list where $qstring LIMIT $num,$no_res";
$res_one_page=mysqli_query($dbconn,$query_one_page) or die('<br>error in query2');
$num_res=mysqli_num_rows($res_one_page);
?>

<?php
while($row=mysqli_fetch_assoc($res_one_page))
		{
			echo "<tr>"."<td class='id'>".$row['prod_id']."</td>"."<td class='name'>".$row['name']."</td>"."<td class='modelno'>".$row['modelno']."</td>"."<td class='pcs'>".$row['pcs']."</td>"."<td class='qty'>".$row['qty']."</td>"."<td class='size'>".$row['size']."</td>"."<td class='type'>".$row['type']."</td>"."<td class='make'>".$row['make']."</td>"."<td class='colour'>".$row['colour']."</td>"."<td class='date'>".$row['date']."</td>"."<td class='price'>".$row['price']."</td>";
	
		}
		echo ','.$no_pages;//.','.$num_res.' '.$num.' '.$no_res;
}
else
echo 21;

?>
