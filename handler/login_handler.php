<?php require "../database/db_connection.php" ?>
<?php require "../function/functions.php"; ?>
<?php
    if(isset($_POST['login']))
    {
    	$email = $_POST['email'];
        $password = $_POST['password'];
                 // authenticate email
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        // echo "$email <br /> $password";
        if(empty($email))
        {
          // echo "$email";exit;
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
            $result = @(mysqli_num_rows($run));
           // $count = count($run);
          //  echo $count;
            if($result > 0)
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