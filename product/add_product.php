<?php require "../database/db_connection.php" ?>
<?php
       session_start();
       $id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Product</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<center>
<h1>Add New Product</h1>
</center>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="form-group">
			<form method="post" action="" enctype="multipart/form-data">
				<label>Product Name</label>
				<input type="text" name="name" required class="form-control"><br><br>
				<label>Discription</label>
				<input type="text" name="discription" class="form-control"><br><br>
				<labe>Product Image</labe>
				<input type="file" name="image" class="btn btn-warning"><br><br>
				<labe>Price</labe>
				<input type="number" name="price" class="form-control" placeholder="PKR"><br><br>
				<input type="submit" name="add" class="btn btn-success">
			</form>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>

<?php
    if(isset($_POST['add']))
    {
    	$name = $_POST['name'];
    	$dis = $_POST['discription'];
    	$image = $_FILES['image']['name'];
    	$image_loc = $_FILES['image']['tmp_name'];
    	$price = $_POST['price'];
    	$image = strtolower($image);
    	$image = str_replace(" ","_",$image);
    	if(empty($name))
    	{
    		die("Product Name is Required");
    	}
    	if(empty($image))
    	{
    		die("Image is Required");
    	}
    	if(empty($price))
    	{
    		die("Price Of Product is Not Enter");
    	}
    	if(move_uploaded_file($image_loc,"../images/$image"))
		{
			$query = "INSERT INTO product(name,discription,image,price) ";
    	$query .= "VALUES('$name','$dis','$image','$price')";
    	$run = mysqli_query($conn,$query);
    	if($run)
    	{
    		$last_id = mysqli_insert_id($conn);
    		$query = "INSERT INTO admin_vs_product(member_id,product_id) VALUES ('$id','$last_id')";
    		$run = mysqli_query($conn,$query);
    		if(!$run)
    		{
    			die("Product add Failed");
    		}
    		else
    		{
    			echo "<script>
    		alert('Product Added Successfully');    		
    		window.location.href='../admin/index.php';
    		</script>";
    		exit;
    		}
    	}

		}
		else
		{
			die("Image Upload Failed");
		}  	
    }
?>