<?php
    if(isset($_POST['login'])){

        $conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();

        $username = mysqli_real_escape_string($conn,$_POST['email']);
        $password = md5($_POST['password']);

        $sql = "SELECT id ,email, first_name, last_name FROM users WHERE email = '{$username}' AND password = '{$password}'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['first_name'] =$row['first_name'];
                $_SESSION['last_name'] =$row['last_name'];
                $_SESSION['id'] = $row['id'];

                header("Location: index.php");
            }

        }
        else{
            session_start();
            $_SESSION['status'] = "Username and Password are not Matched";
            header("Location: signin.php");
            // echo "<script> alert('Username and Password are not Matched '); </script>";
        }
    }
?>