<?php

$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include "_dbconnect.php";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_email = $_POST['SignupEmail'];
    $pass = $_POST['SignupPassword'];
    $cpass = $_POST['SignupCPassword'];


    //check whether this email exists


    $existSql= "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn,$existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0)
    {
        $showError= "Email already in use";
    }

    else
    {
       
           if($pass==$cpass){
               $hash = password_hash($pass,PASSWORD_DEFAULT);
               $sql ="INSERT INTO `users` (`first_name`,`last_name`, `user_email`,`user_pass`,`time_stamp`) VALUES ('$fname','$lname','$user_email','$hash', current_timestamp());";
               $result = mysqli_query($conn,$sql);
               if($result)
               {
                $showAlert = true;
                header("location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        
        else
        {
            $showError = "Passwords do not match";
           
        }
    }
    header("location: /forum/index.php?signupsuccess=false&error=$showError");

}
?>