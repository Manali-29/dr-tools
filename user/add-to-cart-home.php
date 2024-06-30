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
            $sql5 = "SELECT * FROM cart_detail WHERE pro_id = $id AND user_id = $user_id";
            $result5 = mysqli_query($conn, $sql5);
            $row5 = mysqli_fetch_assoc($result5);

            if($row5['pro_id'] == $id)
            {
                $c_quantity = $row5['c_quantity'] + 1;
                $price = $row5['price'];
                $cart_total = $row1['cart_total'] + $price;

                $sql4 = "UPDATE cart SET cart_total = $cart_total WHERE user_id = $user_id ";
                $result4 = mysqli_query($conn, $sql4);

                $sql6 = "UPDATE cart_detail SET c_quantity = $c_quantity WHERE pro_id = $id AND user_id = $user_id";
                $result6 = mysqli_query($conn, $sql6);
                header("Location: index.php");
            }
            else
            {
                $price = $row5['price'] + $row['pro_price'];
                $cart_total = $row1['cart_total'] + $price;

                $sql7 = "UPDATE cart SET cart_total = $cart_total WHERE user_id = $user_id ";
                $result7 = mysqli_query($conn, $sql7);

                $sql8 = "INSERT INTO cart_detail (pro_id, c_quantity, price, cart_id, user_id) VALUES ('{$row['id']}', '1', '{$row['pro_price']}', '{$row1['cart_id']}', $user_id)";
                $result8 = mysqli_query($conn, $sql8);
                header("Location: index.php");
            }
        } 
        else 
        {
            $sql2 = "INSERT INTO cart (user_id, cart_total) VALUES ($user_id, '{$row['pro_price']}')";
            $result2 = mysqli_query($conn, $sql2);

            $cart_id = mysqli_insert_id($conn);

            $sql3 = "INSERT INTO cart_detail (pro_id, c_quantity, price, cart_id, user_id) VALUES ('{$row['id']}', '1', '{$row['pro_price']}', '{$cart_id}', $user_id)";
            $result3 = mysqli_query($conn, $sql3);
            header("Location: index.php");
        }
    } else {
        echo "Session variable 'id' is not set.";
    }
?>