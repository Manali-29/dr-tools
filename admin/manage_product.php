<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active"><a href="manage_product.php">Manage Product</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Manage Product</h5>
                            </div>
                            <div class="col text-end">
                                <div  class="btn mt-3" style="background-color:#7dc6ba;" >
                                    <a class="login-wrap ms-2" style="color:white;" href="./generate-stock-report.php">
                                        <span>Generate Stock Report</span>
                                    </a>
                                </div >
                            </div>
                            <div class="col text-end">
                                <div  class="btn mt-3" style="background-color:#7dc6ba;" >
                                    <a class="login-wrap ms-2" style="color:white;" href="./generate-report.php">
                                        <span>Generate Top Selling Report</span>
                                    </a>
                                </div >
                            </div>
                        </div><hr>
                        <table id="myTable" class="display">
                        <?php 
                            //$conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();
                            include "confing.php";
                            $sql = "SELECT product.id,product.pro_name,product.category_name,category.cat_name FROM product LEFT JOIN category ON product.category_name = category.id ORDER BY product.id DESC";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                        ?>
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <!-- <th>Product Price</th>
                                    <th>Product Description</th> -->
                                    <th>Product Categories</th>
                                    <!-- <th>Product Quantity</th>
                                    <th>Product Detail</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['pro_name']; ?></td>
                                    
                                    <td><?php echo $row['cat_name']; ?></td>
                                    
                                    <td><a href="edit_product.php?id=<?php echo $row['id']; ?>" class="me-3"><img src="../assets/images/images/edit.svg" alt="Edit" /></a>
                                    <a href="delete_product.php?id=<?php echo $row['id']; ?> & catid=<?php echo $row['category_name']; ?>" class=""><img src="../assets/images/deletecon.svg" alt="Delete" /></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>