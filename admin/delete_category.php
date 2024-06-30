<?php
    include "confing.php";

    $cat_id = $_GET['id'];

    $sql = "DELETE FROM category WHERE id = {$cat_id}";
    $sql1 = "SELECT * FROM category WHERE id = {$cat_id}";
    $result = mysqli_query($conn,$sql1) or die("Query Failed : Select");
    $row = mysqli_fetch_assoc($result);

    unlink("Uplode/" . $row['cat_icon']);
    
    if(mysqli_query($conn,$sql))
    {
        header("Location: manage_category.php");
    }
    else
    {
        echo "<p style='color:red;margin: 10px 0;'>Can Not Delete The User Record.</p>";
    }

?>