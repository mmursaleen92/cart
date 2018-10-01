<?php require "../database/db_connection.php" ?>
<?php
    session_start();
    $id = $_GET['edit'];
    $query = "SELECT * FROM product WHERE id = '$id'";
    $run = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($run);
    if($run)
    {
    	$name = $row['name'];
    	$dis = $row['discription'];
    	$image = $row['image'];
    	$price = $row['price'];
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
<form method="post" action="" enctype="multipart/form-data">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-6">
<div class="form-group">
	<label for="name">
		Name :
	</label>
	<input type="text" name="name" required class="form-control" value="<?php echo $name; ?>">
	<br /><br />
	<label> Discription : </label>
	<input type="text" name="discription" required class="form-control" value="<?php echo $dis; ?>">
	<br /><br />
	<label> Image : </label>
	<img  src="../images/<?php echo $image; ?>" class="img-responsive" height="100" width="100">
	<br />
	<label> Change Image : </label>
	<br />
	<input type="file" name="image" class="btn btn-primary" >
	<br /><br />
	<label> Price : </label>
	<input type="text" name="price" required class="form-control" value="<?php echo $price; ?>">
	<br /><br />
	<input type="submit" name="update" class="btn btn-warning" value="Update Product">
	</div>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-2"></div>
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
     	$dis = $_POST['discription'];
     	$price = $_POST['price'];
     	$image = $_FILES['image']['name'];
     	$image = strtolower($image);
     	$image = str_replace(" ","_",$image);
     	$image_loc = $_FILES['image']['tmp_name'];
        $folder = "../images/";
     	if(empty($image))
     	{
     		$query = "UPDATE product SET name = '$name', discription = '$dis', price = '$price' ";
     		$query .="WHERE id = '$id'";
     		$run = mysqli_query($conn,$query);
     		if($run)
     		{
     			echo "<script>
     			alert('Update Successfully...!');
     			window.location.href='../admin/index.php';
     			   </script>";
     			   exit;
     		}
     		else
     		{
     			die('Update Query Failed with NO Image'.mysqli_error($conn));
     		}
     	}
     	elseif(!empty($image))
     	{   
     		if(move_uploaded_file($image_loc,$folder.$image))
     	{
     		$query = "UPDATE product SET name = '$name', discription = '$dis', price = '$price',";
     		$query .=" image = '$image' WHERE id = '$id'";
     		$run = mysqli_query($conn,$query);
     		if($run)
     		{
     			echo "<script>
     			      alert('Update Successfully...');
     			      window.location.href='../admin/index.php';
     			      </script>";     			      
     		}
     		else
     		{
     			die('Update Query Failed With Image'.mysqli_error($conn));
     		}
     		
     	}
     	else
     	{
     		echo 'Image Upload Failed Check Your Image Size';
     	}
     }
     else
     		{
     			echo 'Update Query Failed Image has Issue'.mysqli_error($conn);
     		}
     	}
?>