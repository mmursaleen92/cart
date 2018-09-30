<?php require "../database/db_connection.php" ?>
<?php require "../function/functions.php"; ?>
<?php
    if(isset($_POST['login']))
    {
    	$email = $_POST['email'];
    	$password = $_POST['password'];
        // echo "$email <br /> $password";
        if(empty($email))
        {
            echo 'E-mail Not entered';
            exit;
        }
        elseif(empty($password))
        {
            die('Password Not Entered');
        }
        else
        {
            $password = md5($password);
            $password = sha1($password);
            $query = "SELECT * FROM member WHERE email = '$email' and password = '$password'";
            $run = mysqli_query($conn,$query);
            $count = count($run);
          //  echo $count;
            if($run)
            {
                echo "WELCOME";
                exit;
            }
            else
            {
                die('Wrong E-mail or Password');
            }
        }
        
    }

?>