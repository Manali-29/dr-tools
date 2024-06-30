<?php
    // Start the session and check if 'id' is set in the session variable
    session_start();
    if (isset($_SESSION['id'])) 
    {
        include "confing.php";

        $order_id = $_GET['order_id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql = "DELETE FROM `order` WHERE order_id = $order_id ";
        

        $sql1 = "DELETE FROM order_detail WHERE order_id = $order_id ";
        

        $sql2 = "DELETE FROM payment WHERE order_id = $order_id ";
        

        if(mysqli_query($conn,$sql))
        {
            if(mysqli_query($conn,$sql1))
            {
                if(mysqli_query($conn,$sql2))
                {
                    header("Location: manage_order.php");
                }
                else
                {
                    echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The Message Record.</p>";
                }
            }
            else
            {
                echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The Message Record.</p>";
            }
        }
        else
        {
            echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The Message Record.</p>";
        } 
    } else {
        echo "Session variable 'id' is not set.";
    }
?>