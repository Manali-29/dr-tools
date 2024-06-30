<?php
    // Start the session and check if 'id' is set in the session variable
    session_start();
    if (isset($_SESSION['id'])) 
    {
        include "confing.php";

        $id = $_GET['id'];
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

        $sql = "SELECT * FROM product WHERE id = '{$id}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql1 = "SELECT * FROM cart WHERE user_id = $user_id ";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);

        if($row1['user_id'] == $user_id)
        {   
            $sql5 = "SELECT * FROM cart_detail WHERE pro_id = $id ";
            $result5 = mysqli_query($conn, $sql5);
            $row5 = mysqli_fetch_assoc($result5);

            if($row5['pro_id'] == $id)
            {
                if($row5['c_quantity'] == '1')
                {
                    $price = $row5['price'];
                    $cart_total = $row1['cart_total'] - $price;

                    $sql4 = "UPDATE cart SET cart_total = $cart_total WHERE user_id = $user_id ";
                    $result4 = mysqli_query($conn, $sql4);

                    $sql6 = "DELETE FROM cart_detail WHERE pro_id = $id ";
                    $result6 = mysqli_query($conn, $sql6);
                    header("Location: cart.php");
                }
                else
                {
                    $c_quantity = $row5['c_quantity'] - 1;
                    $price = $row5['price'];
                    $cart_total = $row1['cart_total'] - $price;

                    $sql4 = "UPDATE cart SET cart_total = $cart_total WHERE user_id = $user_id ";
                    $result4 = mysqli_query($conn, $sql4);

                    $sql6 = "UPDATE cart_detail SET c_quantity = $c_quantity WHERE pro_id = $id ";
                    $result6 = mysqli_query($conn, $sql6);
                    header("Location: cart.php");
                }
            }
        } 
    } else {
        echo "Session variable 'id' is not set.";
    }
?>