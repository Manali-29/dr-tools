<?php 
    include "confing.php";
    if(isset($_POST["query"]))
    {
        $output = '';
        $query = "SELECT id, pro_name FROM product WHERE pro_name LIKE '%".$_POST["query"]."%'";
        $result = mysqli_query($conn, $query);
        $output = '<ul class="list-unstyled">';
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $output .= '<li class="text-truncate"><a style="color: black;text-decoration: none;" href="./product-detail.php?id='.$row["id"].'">'.$row["pro_name"].'</a></li><hr>';
            }
        }
        else
        {
            $output .= '<li>Product Not Found</li>';
        }
        $output .= '</ul>';
        echo $output;
    }
?>