<?php
    if(isset($_POST['add']))
    {
        
        include "confing.php";
        if(isset($_FILES['cat_icon'])){
            $errors = array();

            $file_name = $_FILES['cat_icon']['name'];
            $file_size = $_FILES['cat_icon']['size'];
            $file_tmp = $_FILES['cat_icon']['tmp_name'];
            $file_type = $_FILES['cat_icon']['type'];
            $file_ext = end(explode('.',$file_name));
            $extention = array("jpeg","png","jpg","webp","svg");

            if(in_array($file_ext,$extention) === false){
                $errors[] = "This Extention fail not allowed, Pleas choose a PNG and JPG";
            }
            
            if($file_size > 10485760){
                $errors[] = "File Size Must be 2mb or Lower.";
            }

            if(empty($errors) == true){
                move_uploaded_file($file_tmp,"Uplode/" . $file_name);
            }
            else{
                print_r($errors);
                die();
            }
        }   

        $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']); 
        $cat_icon = mysqli_real_escape_string($conn,$_POST['cat_icon']);

        
        $sql = "INSERT INTO category (cat_name,cat_icon) VALUES ('{$cat_name}','{$file_name}')";

        if( mysqli_query($conn,$sql)){
             header("Location: add_category.php");
        }
        else{
            echo " <div class='alert alert-danger'>Query Failed </div>";
        }
        
    }
?>

