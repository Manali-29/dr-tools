<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>
    <!-- banner-section -->
    <section class="banner-section home-banner">
        <div class="owl-carousel owl-theme banner-slider">
            <div class="item">
                <div class="banner-slider-wrap text-center">
                    <img src="./assets/images/images/slider-1_1.jpg" alt="Banne" />
                    <div class="banner-slider-content">
                        <h3>Quality First</h3>
                        <h2>Medical Safety Gears</h2>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="banner-slider-wrap text-center">
                    <img src="./assets/images/images/slider-2_1.jpg" alt="Banne" />
                    <div class="banner-slider-content">
                        <h3>Medical Equipment's</h3>
                        <h2>For Physician & Medical Professional</h2>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="banner-slider-wrap text-center">
                    <img src="./assets/images/images/slider-3_1.jpg" alt="Banne" />
                    <div class="banner-slider-content">
                        <h3>Face Mask</h3>
                        <h2>Prevent The Spread Of Disease</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="our-services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Categories</h2>
                </div>
            </div>
        </div>
        
        <div class="owl-carousel owl-theme our-services-slider">
            <!-- <div class="item"> -->
            
            <?php
                    include "confing.php";
                    
                    $sql = "SELECT * FROM category ORDER BY id DESC";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="item">
           
                <div class="our-services-wrap text-center">
                    <div class="our-services-img">
                    <a href="listing-page.php?cid=<?php echo  $row['id'] ?>"><img src="admin/Uplode/<?php echo $row['cat_icon'] ?>" alt="" /></a>
                    </div>
                    <p><?php echo $row['cat_name'] ?></p>
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
        
    </section>
    <!-- top-products-section -->
    <section class="top-products-section popular-products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h2>Top Products</h2>
                        <div class="view-all">
                            <a href="./listing-page.php" class="view-all-text">View all <img src="./assets/images/view-all-arrow.svg" alt="view-all-arrow" /></a>
                        </div>
                    </div>
                </div>
                <?php
                    include "confing.php";
                    $sql = "SELECT product.id,product.pro_name,product.pro_price,product.pro_desc,product.quantity,product.pro_detail,product.category_name,product.pro_img,category.cat_name FROM product LEFT JOIN category ON product.category_name = category.id LIMIT 8 ";
                    $result = mysqli_query($conn,$sql) or die("Query Failed");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-4">
             
                    <div class="products-wrap">
                    
                        <div class="products-wrap-img position-relative">
                            <a href="./product-detail.php?id=<?php echo $row['id'] ?>">
                                <img src="admin/Uplode/<?php echo $row['pro_img'] ?>" alt="Product" />
                            </a>
                            <?php 
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                {
                            ?>
                            <div class="product-like-cart">
                                <a href="./add-to-cart-home.php?id=<?php echo $row['id']; ?>" class="product-btn"><img src="./assets/images/cart-white.svg" alt="Cart" /></a>
                            </div>
                            <?php 
                                }
                            ?>
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
    <!-- get-in-touch-section -->
    <!-- <section class="get-in-touch-section common-form-section position-relative">
        
    </section> -->
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>