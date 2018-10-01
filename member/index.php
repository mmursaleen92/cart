<?php require "../database/db_connection.php" ?>
<?php
    session_start();
    if(!$_SESSION['id'] && !$_SESSION['email'])
    {
        header("Location:../index.php");
        exit;
    }
    else
    {
       $id = $_SESSION['id'];
    }

?>
<?php 
     $query = "SELECT * FROM member WHERE id = '$id'";
     $run = mysqli_query($conn,$query);      
     $result = mysqli_num_rows($run);
     $row = mysqli_fetch_array($run);

     if($result > 0)
     {
        echo $name = $row['name'];       

     }   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Member Section</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<center>
<h1>Hy : <?php echo $name; ?></h1>
</center>
<div class="row" align="right">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="row left">
<a href="../handler/update_acc.php" class="btn btn-success">Update Your Account</a>
<a href="../handler/logout_handler.php"  class="btn btn-danger">LogOut</a>

</div>
<h2></h2>
<table class ="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Product Name</th>
			<th>Discription</th>
			<th>Product Image</th>
			<th>Product Price</th>
            <th>Buy</th>
        </tr>
	</thead>
    <tbody>
    
    <?php  
    $query = "SELECT * FROM product";
    $run = mysqli_query($conn,$query);
    if($run)
    {
    	while($row = mysqli_fetch_array($run))
		{
			$id = $row['id'];
			$name = $row['name'];
			$discription = $row['discription'];
			$image = $row['image'];
			$price = number_format($row['price']);
			echo "<tr>";
			echo "<td> $name </td>";
			echo "<td> $discription </td>";
				
			?>
			<td><img src="../images/<?php echo $image; ?>" height="100" width="100" class="img-responsive"></td>
			<?php
			echo "<td> $price </td>";
			echo "<td><a href='../handler/update_product.php?edit=$id' class='btn btn-warning'>Edit</td>";
			echo "<td><a href='../handler/delete_product.php?delete=$id' class='btn btn-danger'>Delete</td>";

		}
		
    }
    else
    {
    	die('Query Failed'.mysqli_error($conn));
    }

     ?>
    </tr>;

    </tbody>
</table>
</div>
<div class="col-md-2"></div>
</div>
</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>