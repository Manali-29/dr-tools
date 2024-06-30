<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>
    <!-- listing section -->
    <section class="listing-section">
        <div class="container">
            <div class="row align-items-center listing-row">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-5">
                    <div class="search-main-wrap nav-right visible-xs">
                        <div class="button-main" id="btn">
                            <div class="bar top"></div>
                            <div class="bar middle"></div>
                            <div class="bar bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                        include "confing.php";

                        
                        $sql = "SELECT product.id,product.pro_name,product.pro_price,product.pro_desc,product.quantity,product.pro_detail,product.category_name,product.pro_img,category.cat_name FROM product LEFT JOIN category ON product.category_name = category.id";
                        if(isset($_GET['cid'])){
                            $cat_id = $_GET['cid'];
                            $sql .= " WHERE product.category_name = '{$cat_id}'";
                        }
                        
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 sidebar" id="mySidenav">
                    <div class="products-wrap">
                    
                        <div class="products-wrap-img position-relative">
                            <a href="./product-detail.php?id=<?php echo $row['id'] ?>">
                                <img src="admin/Uplode/<?php echo $row['pro_img'] ?>" alt="Product" />
                            </a>
                            <div class="product-like-cart">
                                <!-- <a href="#" class="product-btn"><img src="./assets/images/like-white.svg" alt="Like" /></a> -->
                                <?php 
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                    {
                                ?>
                                    <a href="./add-to-cart-listing-page.php?id=<?php echo $row['id']; ?>" class="product-btn"><img src="./assets/images/cart-white.svg" alt="Cart" /></a>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="products-detail">
                            <a href="./product-detail.php?id=<?php echo $row['id'] ?>">
                                <h3><?php echo $row['pro_name'] ?></h3>
                            </a>
                            <div class="products-price-rating">
                                <p><?php echo "₹". $row['pro_price'] .".00" ?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php
                        }
                    }
                    else{
                        echo "<h2>NO Record Found.</h2>";
                    }
                ?>
            </div>
        </div>
    </section>
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>