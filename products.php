<?php 
$title="Angel Ceramics";
$page_title="Angel Ceramics";
$nav=2;
$nav_active=2;
$admin=0;
require_once('header.php');
require_once('dbconn.php');
?>
<style>body{
background:rgba(200,200,200,0.6);
}</style>

<div class="container">
<h3><?php echo $page_title ?></h3>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum, nunc ac fermentum mattis, neque mauris tincidunt magna, ac accumsan nisi odio et nisl. Maecenas interdum ligula adipiscing ipsum lobortis, vel viverra quam varius. In hac habitasse platea dictumst. Mauris convallis sagittis arcu, at iaculis leo semper quis. Nunc ut vestibulum dui, laoreet fringilla diam. Donec facilisis dolor varius, sagittis nibh quis, feugiat tellus. Vivamus imperdiet risus ut dolor dictum, ut adipiscing nibh facilisis. Integer vulputate tortor metus, at eleifend nisi bibendum vitae. Curabitur feugiat risus ac risus gravida porta. Sed gravida neque sit amet nunc laoreet, vel lobortis dolor accumsan. In quis nisi mattis diam tristique venenatis. Maecenas interdum eu ipsum id elementum. Integer turpis odio, ultrices vel dolor vitae, auctor ultrices ante. Donec auctor vitae risus at varius. Nulla faucibus risus vitae pharetra semper.
</p>

<div class="product-list">
<?php
$no_res=24;
$curr_page=$num=isset($_GET['num'])?$_GET['num']:1;
$sort_by=isset($_GET['sort'])?$_GET['sort']:'modelno';
$order=isset($_GET['order'])?$_GET['order']:'ASC';
$num=($num-1)*$no_res;
		

$query="select * from product_list";
$res=mysqli_query($dbconn,$query) or die('error in query');
$no_rows=mysqli_num_rows($res);
$query="select * from product_list ORDER BY $sort_by $order LIMIT $num,$no_res";
$res=mysqli_query($dbconn,$query) or die('error in query');

while($row=mysqli_fetch_assoc($res))
		{
			$img=($row['img']=='')?'nf.jpg':$row['img'];
			?>
            <div class="prod">
            <figure>
            <img src=<?php echo IMGPATH.$img;?>  alt="<?php echo $row['name']; ?>">
            <figcaption>
			<?php 
			echo '<span class="prodprop prodname">'.$row['name']."</span>";
			echo '<span class="prodprop">Model.no:'.$row['modelno']."</span>";
			echo '<span class="prodprop">Rs. '.$row['price']."</span>";
			 
			?>
            </figcaption>
            
            </figure>
            
            
            
            </div>
            <?php
			
		}
		
		

?>

 <div id="pagination">Page Links:
        <?php
			$pages=ceil($no_rows/$no_res);
			for($i=1;$i<=$pages;$i++){
				if($i!=$curr_page)
				echo "<a href=products.php?num=$i&sort=$sort_by&order=$order>".$i."</a>";
				else
				echo "<a href=products.php?num=$i&sort=$sort_by&order=$order class=activepage>".$i."</a>";
				
			}
        ?>
  </div>
</div>	
    
<div class="sidebar">
<h4>Sort By:</h4>
<ul>
<li><span class="icon-arrow"></span><a href="products.php?num=<?php echo $curr_page;?>&sort=name&order=<?php echo $order?>">Name</a></li>
<li><span class="icon-arrow"></span><a href="products.php?num=<?php echo $curr_page;?>&sort=price&order=<?php echo $order?>">Price</a></li>
<li><span class="icon-arrow"></span><a href="products.php?num=<?php echo $curr_page;?>&sort=modelno&order=<?php echo $order?>">Model No</a></li>
</ul>

<ul>
<li><span class="icon-arrow"></span><a href="products.php?num=<?php echo $curr_page;?>&sort=<?php echo $sort_by;?>&order=ASC">Ascending Order</a></li>
<li><span class="icon-arrow"></span><a href="products.php?num=<?php echo $curr_page;?>&sort=<?php echo $sort_by;?>&order=DESC">Descending Order</a></li>
</ul>

</div>
  
  </div>

<?php
require_once('footer.php');
?>