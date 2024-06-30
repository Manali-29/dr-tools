<?php
        if(isset($_POST['feed']))
        {
            include "confing.php";

            $full_name = mysqli_real_escape_string($conn,$_POST['full_name']); 
            $email = mysqli_real_escape_string($conn,$_POST['email']); 
            $phone = mysqli_real_escape_string($conn,$_POST['phone']); 
            $message = mysqli_real_escape_string($conn,$_POST['message']);
            
            $sql = "INSERT INTO contactus (full_name,email, phone,message) VALUES ('{$full_name}','{$email}','{$phone}','{$message}')";
            if(mysqli_query($conn,$sql))
            {
                header("Location: contact-us.php");   
            }
            else{
                echo "Query Failed";
            }
        }
?>

