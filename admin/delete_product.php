<?php
    include "confing.php";

    $pro_id = $_GET['id'];
    $cat_id = $_GET['catid'];

    $sql = "DELETE FROM product WHERE id = {$pro_id};";
    $sql .= "UPDATE category SET product_count = product_count - 1 WHERE id = {$cat_id}";

    $sql1 = "SELECT * FROM product WHERE id = {$pro_id}";
    $result = mysqli_query($conn,$sql1) or die("Query Failed : Select");
    $row = mysqli_fetch_assoc($result);

    unlink("Uplode/" . $row['pro_img']);

    if(mysqli_multi_query($conn,$sql))
    {
        header("Location: manage_product.php");
    }
    else
    {
        echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The User Record.</p>";
    }

?>