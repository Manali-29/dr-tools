<?php
    session_start();
    if (isset($_SESSION['id'])) 
    {
        include "confing.php";

        $payment_id = $_GET['id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql = "UPDATE payment SET payment_ststus='success' WHERE payment_id = {$payment_id}";
        $result = mysqli_query($conn, $sql);

        if(mysqli_query($conn,$sql))
        {
            header("Location: manage_payment.php");
        }
        else
        {
            echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The Message Record.</p>";
        }
    } else {
        echo "Session variable 'id' is not set.";
    }
?>