<?php
    // Start the session and check if 'id' is set in the session variable
    session_start();
    if (isset($_POST['place_order'])) 
    {
        include "confing.php";

        $id = $_POST['id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql = "SELECT * FROM product WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql1 = "INSERT INTO `order` (cart_id, sub_total, order_status, user_id) VALUES ('', '{$row['pro_price']}', 'approved', '{$user_id}')";
        $result1 = mysqli_query($conn, $sql1);

        $order_id = mysqli_insert_id($conn);

        $sql3 = "INSERT INTO order_detail (pro_id, order_qty, order_id) VALUES ('{$row['id']}', '1', '{$order_id}')";
        $result3 = mysqli_query($conn, $sql3);

        $sql4 = "INSERT INTO payment (order_id, payment_amount, user_id) VALUES ('{$order_id}', '{$row['pro_price']}', '{$user_id}')";
        $result4 = mysqli_query($conn, $sql4);

        $new_qty = $row['quantity'] - 1;

        $sql5 = "UPDATE product SET quantity = $new_qty WHERE id = {$row['id']}";
        $result5 = mysqli_query($conn, $sql5);

        header("Location: index.php");

    } else {
        echo "Session variable 'id' is not set.";
    }
?>