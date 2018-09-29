<?php require "../function/functions.php"; ?>
<?php
    if(isset($_POST['login']))
    {
    	$email = clear($_POST['email']);
    	$password = clear($_POST['password']);
    	echo "$email <br /> $password";
    }

?>