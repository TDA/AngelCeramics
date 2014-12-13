<?php
require_once('dbconn.php');
$num=$_POST['num'];
$num=($num--)*25 +1;
$no_res=25;

$query="select * from product_list where $qstring LIMIT $num,$no_res";
$res=mysqli_query($dbconn,$query) or die('<br>error in query');
while($row=mysqli_fetch_assoc($res_first_page))
		{
			echo "<tr>"."<td class='id'>".$row['prod_id']."</td>"."<td class='name'>".$row['name']."</td>"."<td class='modelno'>".$row['modelno']."</td>"."<td class='pcs'>".$row['pcs']."</td>"."<td class='qty'>".$row['qty']."</td>"."<td class='size'>".$row['size']."</td>"."<td class='type'>".$row['type']."</td>"."<td class='make'>".$row['make']."</td>"."<td class='colour'>".$row['colour']."</td>"."<td class='date'>".$row['date']."</td>"."<td class='price'>".$row['price']."</td>";
	
		}
?>