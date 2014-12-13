<?php 
session_start();
$title="Admin - Generate MIS";
$page_title="Angel Ceramics - MIS";
$nav=1;
require_once('header.php');
require_once('dbconn.php');
$query="select password from admlog";
$res=mysqli_query($dbconn,$query) or die('error in query');
$storedpass=mysqli_fetch_array($res);
echo '<a href="admin.php" class="back">Back to Admin Home</a>';
if($_SESSION['pass']==$storedpass['password'])
{
	?>
	<form id="searchbox" action="search.php" method="post" >
    <fieldset>
    <label for="from">From</label>
    <input type="text" name="from" id="from" required="required" placeholder="From" ><br>
    
    <label for="to">To</label>
    <input type="text" name="to" id="to" required="required" placeholder="To" >
    </fieldset>
        <fieldset>
        <label for="modelno">Model No</label><input type="search" placeholder="Model No" name="modelno" id="modelno" ><br>
        <label for="name">Brand Name</label><input type="search" placeholder="Name" name="name" id="name" required="required" ><br>
        <label for="size">Size</label><input type="search" placeholder="Size" name="size" id="size" ><br>
        <label for="type">Type</label><input type="search" placeholder="Type" name="type" id="type" ><br>
        <div class="searchhelper"><ul></ul></div>
        </fieldset>
       <input type="button" value="Generate MIS" id="gen">
       <!--<input type="button" value="Search" id="regsearch" >-->
       <input type="reset" value="Reset">
     </form>

<div class="regtitle">
<h3>REGISTER</h3>
<span class="from"></span>
<span class="to"></span>

</div>
<table class="register">


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

<div id="pagination">

</div>
<?php  
}
else
{
echo AUTHERR; 
header('location:admlog.php');
}
require_once('footer.php');
?>
