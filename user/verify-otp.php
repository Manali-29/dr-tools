<?php
    session_start();
    if(isset($_POST['verify']))
    {
        include "confing.php";
        $otp = mysqli_real_escape_string($conn,$_POST['otp']);
        $otp_email = $_SESSION['otp_email'];

        $get_otp = "SELECT otp FROM users WHERE email = '$otp_email'";
        $get_otp_run = mysqli_query($conn, $get_otp);

        if(mysqli_num_rows($get_otp_run) > 0)
        {
            $row = mysqli_fetch_array($get_otp_run);

            if($row['otp'] == $otp)
            {
                $reset_otp = "UPDATE users SET otp = '0' WHERE email = '$otp_email'";
                $run_reset_query =  mysqli_query($conn, $reset_otp);

                header("Location: reset-password.php");
                exit();
            }
            else
            {
                $_SESSION['status'] = "Enter valid OTP";
                header("Location: forgot-password.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "No Eamil Found";
            header("Location: forgot-password.php");
            exit(0);
        }
    }
?>