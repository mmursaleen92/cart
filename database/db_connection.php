<?php
define("host","localhost");
define("user","root");
define("password","");
define("database","cart");

    $conn = mysqli_connect(host,user,password,database);
    if(!$conn)
    {
    	echo 'Data Base Connection Failed'.mysqli_error();
    }
    // else
    // {
    // 	echo 'Connection establish';
    // }


?>