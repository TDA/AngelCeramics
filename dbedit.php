<?php 
session_start();
$title="Admin Edit";
$page_title="Angel Ceramics";
$nav=1;
require_once('header.php');
require_once('dbconn.php');
$query="select password from admlog";
$res=mysqli_query($dbconn,$query) or die('error in query');
$storedpass=mysqli_fetch_array($res);
if($_SESSION['pass']==$storedpass['password'])
{
	echo '<a href="admin.php" class="back">Back to Admin Home</a>';

	?>
	<?php
	$action=$_GET['action'];
	
	if($action=='add')
	{
		if(isset($_GET['msg'])){
		$msg=$_GET['msg'];
		echo '<div class="success">Added Successfully!</div>';
		}
		?>
    	
		
		

        <form action="addprod.php" method="post" enctype="multipart/form-data">
        <fieldset>
        <label for="modelno">Model No</label><input type="number" placeholder="Model No" name="modelno" id="modelno" required onblur="checkavail(this.id)"><br>
        <label for="name">Brand Name</label><input type="text" placeholder="name" name="name" id="name" required><br>
        <label for="size">Size</label><input type="number" placeholder="Size" name="size" id="size" required><br>
        <label for="type">Type</label>
        <select name="type" id="type" required>
        <option>Vitrified Tiles</option>
        <option>Wall Tiles</option>
        <option>Floor Tiles</option>
        <option>Digital Tiles</option>
        <option>Sanitaryware</option>
        <option>Red Tiles</option>
        </select>
        <br>
        <label for="stock">Quantity</label><input type="number" placeholder="stock" name="stock" id="stock" required>
        <label for="pcs">Pcs / Per Box</label><input type="number" placeholder="pieces per box" name="pcs" id="pcs" required><br>

        </fieldset>
        <fieldset>
        <label for="make">Make</label><select name="make" id="make" required>
        <option>Indian Tiles</option>
        <option>Imported Tiles</option>
        </select><br>
        <label for="colour">Colour</label><input type="text" placeholder="colour" name="colour" id="colour" required><br>
        <label for="date">Received Date</label><input type="date" placeholder="date" name="date" id="date" required><br>
        <label for="price">Price/Per Box</label><input type="number" placeholder="price" name="price" id="price" required><br>
        <label for="img">Design/Image</label><input type="file" placeholder="image" name="img" id="img"><br>

        </fieldset>
        <input type="submit" value="ADD" id="add">
        </form>
        
        <?php
		
	}
	else if($action=='edit')
	{	
		?>
        <form action="dbedit.php?action=edit" method="post" id="edit-searcher">
        <fieldset>
        <label for="modelno-search">Model No</label><input type="number" placeholder="Model No" name="modelno-search" id="modelno-search" required>
        </fieldset>
        <input type="submit" name="search" value="Search" id="edit-search">
        </form>
        <?php
        if(isset($_POST['search'])){
			$qstring='modelno='.$_POST['modelno-search'];
		}
		else
		$qstring=true;
		$no_res=25;	
		if(isset($_GET['num']))
		{
			$curr_page=$num=$_GET['num'];	
			$num=($num-1)*$no_res;
		}
		else{
			
			$num=0;
			$curr_page=1;
		}
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
		}
		
		$query="select * from product_list where $qstring ORDER BY prod_id,modelno";
		$res=mysqli_query($dbconn,$query) or die('error in query');
		$no_rows=mysqli_num_rows($res);
		$query="select * from product_list where $qstring ORDER BY prod_id,modelno LIMIT $num,$no_res ";
		$res=mysqli_query($dbconn,$query) or die('error in query');
		
		
		?>
    <div id="editor">
    <form enctype="multipart/form-data" action="editprod.php" method="post">
        <fieldset>
        <label for="pid">Product Id</label><input type="text" id="pid"  name="pid" required="required" readonly="readonly"><br>
        <label for="modelno">Model No</label><input type="number" placeholder="Model No" name="modelno" id="modelno" required><br>
        <label for="name">Brand Name</label><input type="text" placeholder="name" name="name" id="name" required><br>
        <label for="size">Size</label><input type="number" placeholder="Size" name="size" id="size" required><br>
        <label for="type">Type</label>
        <select name="type" id="type" required>
        <option>Vitrified Tiles</option>
        <option>Wall Tiles</option>
        <option>Floor Tiles</option>
        <option>Digital Tiles</option>
        <option>Sanitaryware</option>
        <option>Red Tiles</option>
        </select>
        <br>
        <label for="stock">Quantity</label><input type="number" placeholder="stock" name="stock" id="stock" required>
        <label for="pcs">Pcs / Per Box</label><input type="number" placeholder="pieces per box" name="pcs" id="pcs" required><br>

        </fieldset>
        <fieldset>
        <label for="make">Make</label><select name="make" id="make" required>
        <option>Indian Tiles</option>
        <option>Imported Tiles</option>
        </select><br>
        <label for="colour">Colour</label><input type="text" placeholder="colour" name="colour" id="colour" required><br>
        <label for="date">Received Date</label><input type="date" placeholder="date" name="date" id="date" required><br>
        <label for="price">Price/Per Box</label><input type="number" placeholder="price" name="price" id="price" required><br>
        <label for="img">Design/Image</label><input type="file" placeholder="image" name="img" id="img" ><br>

        </fieldset>
           <input type="submit" value="UPDATE" id="update">
        </form>
        </div>
	    
		<table class="exportable-table">
        <tr>
			<th>Product ID</th>
            <th>Product Name</th>
            <th>Model No</th>
			<th>Pcs/Box</th>
			<th>Quantity</th>
			<th>Size</th>
			<th>Type</th>
            <th>Make</th>
            <th>Colour</th>
            <th>Date</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Remove</th>
		</tr>
	
        <?php
		while($row=mysqli_fetch_array($res))
		{
			echo "<tr>"."<td class='id'>".$row['prod_id']."</td>"."<td class='name'>".$row['name']."</td>"."<td class='modelno'>".$row['modelno']."</td>"."<td class='pcs'>".$row['pcs']."</td>"."<td class='qty'>".$row['qty']."</td>"."<td class='size'>".$row['size']."</td>"."<td class='type'>".$row['type']."</td>"."<td class='make'>".$row['make']."</td>"."<td class='colour'>".$row['colour']."</td>"."<td class='date'>".$row['date']."</td>"."<td class='price'>".$row['price']."</td>"."<td><a href='' class='edit' value='".$row['prod_id']."'><i class='icon-edit'></i>Edit</a></td>"."<td><a href='' class='remove' value='".$row['prod_id']."'><i class='icon-remove'></i>Remove</a></td></tr>";
		}
		?>
        </table>
        <div id="pagination">Page Links:
        <?php
			$pages=ceil($no_rows/$no_res);
			for($i=1;$i<=$pages;$i++){
				if($i!=$curr_page)
				echo "<a href=dbedit.php?action=edit&num=$i>".$i."</a>";
				else
				echo "<a href=dbedit.php?action=edit&num=$i class=activepage>".$i."</a>";
				
			}
        ?>
        </div>
        <button onclick="export_xl();">
            Get as Excel spreadsheet
        </button>

        <?php
	}
	
}
else
{
echo AUTHERR;
echo 'Kindly Login again';
header('location:admlog.php');
}

require_once('footer.php');

?>

