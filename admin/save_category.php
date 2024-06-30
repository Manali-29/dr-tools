<?php
    include "confing.php";

    if(empty($_FILES['cat_icon']['name'])){
        $file_name = $_POST['old_image'];
    }else{
            $errors = array();

            $file_name = $_FILES['cat_icon']['name'];
            $file_size = $_FILES['cat_icon']['size'];
            $file_tmp = $_FILES['cat_icon']['tmp_name'];
            $file_type = $_FILES['cat_icon']['type'];
            $file_ext = end(explode('.', $file_name));
            $extention = array("jpeg","png","jpg","webp","svg");

            if(in_array($file_ext,$extention) === false){
                $errors[] = "This Extention fail not allowed, Pleas choose a PNG and JPG";
            }
            
            if($file_size > 10485760){
                $errors[] = "File Size Must be 10mb or Lower.";
            }

            if(empty($errors) == true){
                move_uploaded_file($file_tmp,"Uplode/" . $file_name);
            }
            else{
                print_r($errors);
                die();
            }

        }
    
      
    $sql = "UPDATE category SET cat_name='{$_POST["cat_name"]}',cat_icon='{$file_name}' WHERE id = {$_POST["id"]}";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: edit_category.php?id=".$_POST['id']);
    }else{
        echo "Query Failed.";
    }
?>