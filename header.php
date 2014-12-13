<!doctype html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Sai Prashanth">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<link rel="icon" type="image/png" href="favicon.png">

<!--[if lt IE 9]>  
<script src="html5shiv.js"></script> 
<script src="respond.min.js" type="text/javascript"></script>
<script src="selectivizr-min.js" type="text/javascript"></script>
 
<![endif]--> 

<link rel="stylesheet" href="normalize.css">
<link rel="stylesheet" href="first.css">
<link rel="stylesheet" href="sitewide.css">

</head>

<body>
<section id="container">
<header>

	<h2><a href="index.php"><img src="Images/logo.jpg"></a><?php echo $page_title ?></h2>
    <?php
	if(isset($admin)&&$admin==0)
    echo '<a href="admlog.php" class="admlog">Admin Login</a>';
	?>
<?php
if($nav==1)
{
	?>
	<nav class="admlogin">
	<ul>
	<li><a href="dbedit.php?action=add">Add</a></li>
	<li><a href="dbedit.php?action=edit&num=1">Edit</a></li>
	<li><a href="dbsearch.php?action=search">Search</a></li>
	<li><a href="dbsearch.php?action=check">Quality</a></li>
    <li><a href="dbgen.php">Generate MIS</a></li>
    <li><a href="dbsearch.php?action=stock">Stock</a></li>
    <li><a href="dbbilling.php">Billing</a></li>
    <li><a href="index.php">Home</a></li>

	</ul>
	</nav>
     
        
        
        
       
<?php
}
else if($nav==2){
?>
<nav class="custonav">
	<ul>
	<li><a href="index.php" class="<?php echo ($nav_active==1)?'current':''; ?>" >Home</a></li>
	<li><a href="products.php" class="<?php echo ($nav_active==2)?'current':''; ?>">Products</a></li>
	<li><a href="cus.php" class="<?php echo ($nav_active==3)?'current':''; ?>">Contact Us</a></li>
	</ul>
    <div id="nav-blob"></div>
</nav>
    
<?php
}
?>
</header>
