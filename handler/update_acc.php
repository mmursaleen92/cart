<?php require "../database/db_connection.php" ?>
<?php
    session_start();
    $id = $_SESSION['id'];
    $query = "SELECT name FROM member WHERE id = '$id'";
    $run = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($run);
    if($run)
    {
    	$name = $row['name'];
    }        
    else
    {
    	die("Somethin Wron Happen :-(");
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Your Account</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
 <h1></h1>
<form method="post" action="">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="form-group">
	<label for="name">
		Name :
	</label>
	<input type="text" name="name" required class="form-control" value="<?php echo $name; ?>">
	<br /><br />
	<input type="submit" name="update" class="btn btn-warning">
	</div>
	</div>
	<div class="col-md-4"></div>
	</div>
</form>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    if(isset($_POST['update']))
    {
    	$name = $_POST['name'];
    	if(empty($name))
    	{
    		die("Please Enter a correct Name");
    	}
    	else
    	{
    		$query = "UPDATE member SET name = '$name' WHERE id = '$id'";
    		$run = mysqli_query($conn,$query);
    		// $row = mysqli_fetch_array($run);
    		if($run)
    		{
    			echo "<script>
    			alert('Update Success');
    			window.location.href='../admin/index.php';
    			</script>";
    		}
    		else
    		{
    			die("Something Went Wrong");
    		}
    	}

    }
?>