<?php
define("IMGPATH", "Images/");
define("AUTHERR", "Sorry mate, You dont seem to have the authentication to enter in here header");
$dbname="angelceramics";
$uname="root";
$server="localhost";


$dbconn= mysqli_connect("$server","$uname","","$dbname") or die('Invalid Password');
?>