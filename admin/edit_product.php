<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active"><a href="manage_product.php">Manage Product</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Edit Product</h5>
                        <?php
                            include "confing.php";
                            $id = $_GET['id'];

                            $sql = "SELECT product.id,product.pro_name,product.pro_price,product.pro_desc,product.quantity,product.pro_detail,product.category_name,product.pro_img,category.cat_name FROM product LEFT JOIN category ON product.category_name = category.id WHERE product.id = {$id}";

                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <form class="row g-3" action="save_product.php" method="POST" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="id" value="<?php echo $row['id']; ?>" disabled >
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                                    <label for="pro_id">Product Id :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php echo $row['pro_name']; ?>" placeholder="Enter Product Name">
                                    <label for="pro_name">Product Name</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pro_price" name="pro_price" value="<?php echo $row['pro_price']; ?>" placeholder="Enter Product Price">
                                    <label for="pro_price">Product Price</label>
                                </div>
                            </div>
                                
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea  class="form-control" placeholder="Enter Product Description" id="pro_desc" name="pro_desc" style="height: 100px;"><?php echo $row['pro_desc']; ?></textarea>
                                    <label for="pro_desc">Product Description</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" placeholder="Enter Product Quantity">
                                    <label for="pro_quantity">Product Quantity</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Enter Product Details" id="pro_detail" name="pro_detail"  style="height: 100px;"><?php echo $row['pro_detail']; ?></textarea>
                                    <label for="pro_details">Product Details</label>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-floating">
                                        <select class="form-control" name="category_name" id="category_name">
                                        <option disabled></option>
                                        <?php
                                             $conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();
                                             $sql1 = "SELECT * FROM category";
                                             $result1 = mysqli_query($conn,$sql1) or die("Query Feiled");
                                             if(mysqli_num_rows($result1) > 0){
                                                 while($row1 = mysqli_fetch_assoc($result1)){
                                                    if($row['category_name'] == $row1['id']){
                                                        $selected = "Selected";
                                                    }else{
                                                        $selected = "";
                                                    }
                                                    echo "<option {$selected} value='{$row1['id']}'>{$row1['cat_name']} </option>"; 
                                                 }

                                             }
                                        ?>
                                        </select>
                                        <label for="category_name">Categories</label>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="pro_img" name="pro_img">
                                    <img src="Uplode/<?php echo $row['pro_img'] ?>" height="150px">
                                    <input type="hidden" name="old_image" value="<?php echo $row['pro_img'] ?>">
                                </div>
                            </div>
                
                            <div class="text-center">
                                <button type="submit" class="btn" style="background-color: #2aa1a8;">Update Product</button>
                            </div>
                        </form>
                        <?php
                                }
                            }else{
                                echo "Result Not Found.";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>