<?php
    if(isset($_POST['pro_submit']))
    {
    
        include "confing.php";
        if(isset($_FILES['pro_img'])){
            $errors = array();

            $file_name = $_FILES['pro_img']['name'];
            $file_size = $_FILES['pro_img']['size'];
            $file_tmp = $_FILES['pro_img']['tmp_name'];
            $file_type = $_FILES['pro_img']['type'];
            $file_ext = end(explode('.',$file_name));
            $extention = array("jpeg","png","jpg","webp","svg");

            if(in_array($file_ext,$extention) === false){
                $errors[] = "This Extention fail not allowed, Pleas choose a PNG and JPG";
            }
            
            if($file_size > 10485760){
                $errors[] = "File Size Must be 2mb or Lower.";
            }

            if(empty($errors) == true){
                move_uploaded_file($file_tmp,"Uplode/".$file_name);
            }
            else{
                print_r($errors);
                die();
            }
        }   
        $pro_name = mysqli_real_escape_string($conn, $_POST['pro_name']); 
        $pro_price = mysqli_real_escape_string($conn,$_POST['pro_price']);
        $pro_desc = mysqli_real_escape_string($conn,$_POST['pro_desc']);
        $category_name = mysqli_real_escape_string($conn,$_POST['category_name']);
        $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
        $pro_detail = mysqli_real_escape_string($conn,$_POST['pro_detail']);
        $pro_img = mysqli_real_escape_string($conn,$_POST['pro_img']);

        $product_count = mysqli_real_escape_string($conn,$_POST['product_count']);


        $sql = "INSERT INTO product(pro_name,pro_price,pro_desc,category_name,quantity,pro_detail,pro_img) VALUES ('{$pro_name}','{$pro_price}','{$pro_desc}',{$category_name},'{$quantity}','{$pro_detail}','{$file_name}');";
        $sql .= "UPDATE category SET product_count = product_count + 1 WHERE id = {$category_name}";
   
        if(mysqli_multi_query($conn,$sql)){
             header("Location: add_product.php");
        }
        else{
            echo " <div class='alert alert-danger'>Query Failed </div>";
        }
        
    }
?>

