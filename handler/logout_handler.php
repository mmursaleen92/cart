<?php require "../database/db_connection.php"; ?>
<?php 
  session_start();
  session_destroy();
  header("Location:../index.php");
  ?>