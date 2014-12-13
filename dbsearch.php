<?php 
session_start();
$title="Admin Search";
$page_title="Angel Ceramics";
$nav=1;
require_once('header.php');
require_once('dbconn.php');
$query="select password from admlog";
$res=mysqli_query($dbconn,$query) or die('error in query');
$storedpass=mysqli_fetch_array($res);
echo '<a href="admin.php" class="back">Back to Admin Home</a>';
$action=$_GET['action'];
	
if($_SESSION['pass']==$storedpass['password'])
{
	?>
    <form id="searchbox" action="search.php" method="post" >
        <fieldset>
        <label for="modelno">Model No</label><input type="search" placeholder="ModelNo" name="modelno" id="modelno" 
		<?php
		if($action!='search')
        echo 'onblur="updateothers(this.id)" '
		?>
        value="">
        <br>
        <label for="name">Brand Name</label><input type="search" placeholder="name" name="name" id="name"><br>
        <label for="size">Size</label><input type="search" placeholder="Size" name="size" id="size" ><br>
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
        
      
        </fieldset>
        <fieldset>
        <label for="make">Make</label><select name="make" id="make" required>
        <option>Indian Tiles</option>
        <option>Imported Tiles</option>
        </select><br>
        <label for="colour">Colour</label><input type="search" placeholder="colour" name="colour" id="colour" ><br>
        <label for="date">Received Date</label><input type="search" placeholder="date" name="date" id="date" ><br>
        <label for="pricestart">Price Start</label><input type="range" step="10" min="0" max="10000" value="0" name="pricestart" id="pricestart" oninput="this.form.samount.value=this.value;this.form.priceend.min=this.value;">
      <output name="samount" id="samount"></output><br>
      <label for="priceend">Price End</label><input type="range" step="100" min="0" max="10000" value="10000" name="priceend" id="priceend" oninput="this.form.eamount.value=this.value">
      <output name="eamount" id="eamount"></output><br>
        
        </fieldset>
        <div class="searchhelper"><ul></ul></div>
    <?php
	
	if($action=='search')
	{
		?>
        <input type="button" value="SEARCH" id="search">
        </form>
		<?php
	}
	else if($action=='check')
	{
		?>
        <input type="button" value="CHECK" id="qualcheck">
        </form>
		<?php
	}
	else if($action=='stock')
	{
		?>
        <input type="button" value="Check Stock" id="checkstock">
        </form>
		<?php
	}
	

?>
<table class="search-results">
<thead>
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
</tr>
</thead>
<tbody>
</tbody>
</table>

<div id="pagination"></div>
<table class="quality-results">
<thead>
<tr>
	<th colspan="2"> Search Results </th>
</tr>
</thead>
<tbody>
</tbody>
</table>

<button onclick="export_xl();">
            Get as Excel spreadsheet
        </button>
      
<?php
}
else
{
	echo AUTHERR; 
	header('location:admlog.php');
}
require_once('footer.php');
?>

    	
		
		

        