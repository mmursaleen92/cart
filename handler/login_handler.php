<?php require "../database/db_connection.php" ?>
<?php require "../function/functions.php"; ?>
<?php ob_start(); ?>
<?php
    if(isset($_POST['login']))
    {
    	$email = $_POST['email'];
        $password = $_POST['password'];                 
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
            $row = mysqli_fetch_array($run);
            $result = mysqli_num_rows($run);
          // $count = count($run);
          //  echo $count;
            if($result > 0)
            {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email']; 
                if(!$email == "admin@gmail.com")
                {
                    header("Location:../member/index.php");
                    exit;                    
                } 
                else
                {
                    header("Location:../admin/index.php");
                      exit;                    
                }              
                
            }
            else
            {
                die('Wrong E-mail or Password');
            }
        }
        
    }
?>