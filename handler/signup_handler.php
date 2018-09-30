<?php require "../function/functions.php"; ?>
<?php require "../database/db_connection.php"; ?>
<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST') // take data from signup form
    {
    	$name = clear($_POST['user_name']);
    	$email = clear($_POST['user_email']);
    	$password = clear($_POST['password']);
    	$confirm_password = clear($_POST['confirm_password']);

    	// check for empty fields
    	if(empty($name))
    	{
    		die("Name field is empty");
    	}
    	if(empty($email))
    	{
    		die("E-mail field is empty");
    	}
    	if(empty($password))
    	{
    		die("Password field is empty");
    	}
    	if($password !== $confirm_password)
    	{
    		die("Password not Match");
    	}
    	elseif(strlen($password) < 6) // connected with password match
    	{
    		die("Password Strength Must be 6 Character");
    	}
    	else // if every thing goes right
    	{
    		// encrypt password for more security
    		$password = md5($password);
			$password = sha1($password);
			// $query = $conn->prepare("INSERT INTO member(name,email,password,timee) VALUES (:name,:email,:password,:tim)");
			// $query->execute(['name' => $name],['email' => $email],['password' => $password],['tim' => now()]);
    		$query = "INSERT INTO member(name,email,password,timee) ";
    		$query .="VALUES('$name','$email','$password',now())";
    		$run = mysqli_query($conn,$query);
    		if($run)
    		{
    			echo "<script>
    			alert('Account Created Successfully');
    			</script>";
    		}
    		else
    		{
    			die('Query Failed Data not insert'.mysqli_error($conn));
    		}
    	}

    }

?>