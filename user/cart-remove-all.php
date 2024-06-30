<?php
    // Start the session and check if 'id' is set in the session variable
    session_start();
    if (isset($_SESSION['id'])) 
    {
        include "confing.php";

        $id = $_GET['id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql1 = "SELECT * FROM cart WHERE user_id = $user_id ";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);

        if($row1['user_id'] == $user_id)
        {   
            $sql4 = "UPDATE cart SET cart_total = '0' WHERE user_id = $user_id ";
            $result4 = mysqli_query($conn, $sql4);

            $sql6 = "DELETE FROM cart_detail WHERE cart_id = {$row1['cart_id']} AND user_id = $user_id ";
            $result6 = mysqli_query($conn, $sql6);
            header("Location: cart.php");
        } 
    } else {
        echo "Session variable 'id' is not set.";
    }
?>