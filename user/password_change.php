<?php
    session_start();
    
    include "smtp/PHPMailerAutoload.php";

    function send_password_reset($name, $email)
    {
        $otp = rand(999999, 111111);

        $subject = "Email Verification OTP";
        $message = "Your verification OTP is $otp";
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
        $mail->Username = "uttamdholariya1@gmail.com";
        $mail->Password = "rgfk nyor jiiq jpob";
        $mail->SetFrom("uttamdholariya1@gmail.com");
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
            $_SESSION['status'] = "We've sent a verification code to your email";
            $_SESSION['otp_email'] = $email;

            include "confing.php";
            $insert_otp = "UPDATE users SET otp = $otp WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_otp);

            header("Location: forgot-password.php");
            exit();
        }
    }

    if(isset($_POST['forgot']))
    {
        include "confing.php";
        $email = mysqli_real_escape_string($conn,$_POST['email']);

        $reset_otp = "UPDATE users SET otp = '0' WHERE email = '$email'";
        $run_reset_query =  mysqli_query($conn, $reset_otp);

        $check_email = "SELECT email,first_name,last_name FROM users WHERE email = '$email'";
        $check_email_run = mysqli_query($conn, $check_email);

        if(mysqli_num_rows($check_email_run) > 0)
        {
            $row = mysqli_fetch_array($check_email_run);
            $name = $row['first_name'] . " " . $row['last_name'];
            $email = $row['email'];

            send_password_reset($name,$email);

        }
        else
        {
            $_SESSION['status'] = "No Eamil Found";
            header("Location: forgot-password.php");
            exit();
        }
    }
?>