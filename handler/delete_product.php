<?php require"../database/db_connection.php" ?>
<?php
   $id = $_GET['delete'];
   $query = "DELETE FROM product WHERE id = '$id'";
   $run = mysqli_query($conn,$query);
   if($run)
   {
   	echo "<script>
   	alert('Delete Success');
   	window.location.href='../admin/index.php';
   	</script>";
   }
   else
   {
   	die('Not Able to delete this Product'.mysqli_error($conn));
   }

   ?>