<?php
        include "../smtp/PHPMailerAutoload.php";
        if(isset($_POST['create']))
        {
            $conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();
            $fname = mysqli_real_escape_string($conn,$_POST['first_name']); 
            $lname = mysqli_real_escape_string($conn,$_POST['last_name']); 
            $email = mysqli_real_escape_string($conn,$_POST['email']); 
            $password = mysqli_real_escape_string($conn,md5($_POST['password'])); 
            $cpassword = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
            
            $sql = "SELECT * FROM users WHERE email = '{$email}'";
            $result = mysqli_query($conn,$sql) or die("Query Failed.");

            if(mysqli_num_rows($result) > 0)
            {
                session_start();
                $_SESSION['status'] = "Email Already Exists.";
                header("Location: signup.php");

            }
            else
            {
                $sql1 = "INSERT INTO users (first_name, last_name, email, password,user_type) VALUES ('{$fname}','{$lname}','{$email}','{$password}','1')";

                if(mysqli_query($conn,$sql1))
                {
                       // Email
                    $subject = "Register Successfull";
                    $message = "Thank you for registering! Your account has been created.";
                    $to = $email;

                    $mail = new PHPMailer(); 
                    $mail->isSMTP(); 
                    $mail->SMTPAuth = true; 
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAutoTLS = true;
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 587; 
                    $mail->IsHTML(true);
                    $mail->CharSet = 'UTF-8';
                    //$mail->SMTPDebug = 2; 
                    $mail->Username = "sakariyamanali7@gmail.com";
                    $mail->Password = "zhnz eafn afty bybm";
                    $mail->SetFrom("sakariyamanali7@gmail.com");
                    $mail->Subject = $subject;
                    $mail->Body =$message;
                    $mail->AddAddress($to);
                    $mail->SMTPOptions=array('ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>false
                    ));

                    if(!$mail->Send()){
                        echo $mail->ErrorInfo;
                    }
                    else {
                        header('Location: signin.php');
                    }
                }
            }
        }
?>