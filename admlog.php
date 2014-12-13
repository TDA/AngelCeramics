<?php
$title="Admin Login";
$page_title="Angel Ceramics";
$nav=0;
require_once('header.php');

?>
<form id="login" action="admin.php" method="post">

<h3>Log In - Welcome to Inventory System</h3>
<fieldset>
<input type="text" name="username" placeholder="Username" value="admin" disabled><br />
<input type="password" name="password" placeholder="Password">
</fieldset>
<input type="submit" value="submit" name="submit">
</form>
<?php
require_once('footer.php');
?>