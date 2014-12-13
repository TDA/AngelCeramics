<?php 
session_start();
$title="Admin Home";
$page_title="Angel Ceramics";
$nav=0;
require_once('header.php');
require_once('dbconn.php');

if(isset($_POST['submit']))
{
$pass=$_POST['password'];

$pass=SHA1($pass);
$_SESSION['pass']=$pass;
$query="select password from admlog";
$res=mysqli_query($dbconn,$query) or die('error in query');
$storedpass=mysqli_fetch_array($res);
if($pass==$storedpass['password'])
	{
		?>
        <a href="dbedit.php?action=add">Add</a>
        <a href="dbedit.php?action=edit&num=1">Edit</a>
        <a href="dbsearch.php?action=search">Search</a>
        <a href="dbsearch.php?action=check">Quality Check</a>
        <a href="dbgen.php">Generate MIS</a>
        <a href="dbsearch.php?action=stock">Stock in Hand</a>
        <a href="dbbilling.php">Billing</a>
        
        <?php
	}
else{
	echo $pass." is invalid";
}

}
else if($_SESSION['pass'])
{
	$query="select password from admlog";
$res=mysqli_query($dbconn,$query) or die('error in query');
$storedpass=mysqli_fetch_array($res);
if($_SESSION['pass']==$storedpass['password'])
	{
		?>
        <a href="dbedit.php?action=add">Add</a>
        <a href="dbedit.php?action=edit&num=1">Edit</a>
        <a href="dbsearch.php?action=search">Search</a>
        <a href="dbsearch.php?action=check">Quality Check</a>
        <a href="dbgen.php">Generate MIS</a>
        <a href="dbsearch.php?action=stock">Stock in Hand</a>
        <a href="dbbilling.php">Billing</a>
        
		
		
		

       
        <?php
	}

}
else{
	echo AUTHERR;
}
?>

<?php 
require_once('footer.php');
?>