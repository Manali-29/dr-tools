<?php
        if(isset($_POST['save']))
        {
            include "confing.php";
           
            session_start(); 
            $id = $_SESSION['id'];
            $gender = mysqli_real_escape_string($conn,$_POST['gender']); 
            $dob = mysqli_real_escape_string($conn,$_POST['dob']); 
            $address = mysqli_real_escape_string($conn,$_POST['address']); 
            $postal_code = mysqli_real_escape_string($conn,md5($_POST['postal_code'])); 
            
            $sql = "UPDATE users SET first_name='{$_POST["first_name"]}',last_name='{$_POST["last_name"]}',email='{$_POST["email"]}',gender='{$gender}',dob='{$_POST["dob"]}',phone_no='{$_POST["phone_no"]}',address='{$_POST["address"]}',postal_code='{$_POST["postal_code"]}' WHERE id = {$id}";
            if(mysqli_query($conn,$sql))
            {
                header("Location: my-account.php");   
            }else{
                echo "Query Failed.";
            }

        }
?>