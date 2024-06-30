<?php
    // Start the session and check if 'id' is set in the session variable
    session_start();
    if (isset($_SESSION['id'])) 
    {
        include "confing.php";

        $order_id = $_GET['id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql3 = "SELECT * FROM order_detail WHERE order_id = $order_id ";
        $result3 = mysqli_query($conn, $sql3);

        while($row = mysqli_fetch_assoc($result3))
        {
            $sql4 = "SELECT quantity FROM product WHERE id = {$row['pro_id']}";
            $result4 = mysqli_query($conn, $sql4);

            $row2 = mysqli_fetch_assoc($result4);
            $new_qty = $row2['quantity'] + $row['order_qty'];

            $sql5 = "UPDATE product SET quantity = $new_qty WHERE id = {$row['pro_id']}";
            $result5 = mysqli_query($conn, $sql5);
        }

        $sql = "DELETE FROM `order` WHERE order_id = $order_id ";
        $result = mysqli_query($conn, $sql);

        $sql1 = "DELETE FROM order_detail WHERE order_id = $order_id ";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "DELETE FROM payment WHERE order_id = $order_id ";
        $result2 = mysqli_query($conn, $sql2);

        header("Location: my-account.php");
    } else {
        echo "Session variable 'id' is not set.";
    }
?>