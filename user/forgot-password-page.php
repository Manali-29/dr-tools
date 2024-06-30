<?php
    session_start();
    include "confing.php";

    $reset_otp = "UPDATE users SET otp = '0'";
    $run_reset_query =  mysqli_query($conn, $reset_otp);
    header("Location: forgot-password.php");
?>