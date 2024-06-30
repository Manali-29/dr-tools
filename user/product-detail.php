<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>

    <section class="product-detail-section">
        <div class="container">
            <div class="row">
                <div class="row align-items-center listing-row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Monitoring Devices</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="product-inner">
            <?php
                include "confing.php";
                $id = $_GET['id'];
                $sql = "SELECT product.id,product.pro_name,product.pro_price,product.pro_desc,product.quantity,product.pro_detail,product.category_name,product.pro_img,category.cat_name FROM product LEFT JOIN category ON product.category_name = category.id WHERE product.id={$id} ";
                $result = mysqli_query($conn,$sql) or die("Query Feiled");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product-detail-slider-main">
                            <div id="sync1" class="owl-carousel owl-theme">
                                <div class="item">
                                  <img src="admin/Uplode/<?php echo $row['pro_img'] ?>" alt="Image" />
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product-detail-wrapper">
                            <h2><?php echo $row['pro_name'] ?></h2>
                            <p class="p-reg-16"><?php echo $row['pro_desc'] ?></p>
                            <div class="product-prices-wrapper">
                                <p class="p-primary-24"><?php echo "₹". $row['pro_price'] .".00" ?></p>
                            </div>
                            </div>
                            <div class="text-center buttons-wrap submit-btn-wrap">
                                <?php 
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                    {
                                ?>
                                <a href="./add-to-cart.php?id=<?php echo $row['id']; ?>" style="text-decoration-line:none" type="submit" class="g-btn f-btn border-btn mb-0">Add To Cart</a>
                                <a href="./product_checkout.php?id=<?php echo $row['id']; ?>" style="text-decoration-line:none" type="submit" class="g-btn f-btn mb-0">Check Out</a>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                        <a href="" style="text-decoration-line:none" type="submit" class="g-btn f-btn border-btn mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Add To Cart</a>
                                        <a href="" style="text-decoration-line:none" type="submit" class="g-btn f-btn mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Check Out</a>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="free-main-text">
                                <p>Free delivery if you order today <span class="star">*</span></p>
                                <p>Category: <span class="b-text-category"><a href="listing-page.php?cid=<?php echo  $row['category_name'] ?>"><?php echo  $row['cat_name'] ?> </a></span> </p>
                            </div>
                        </div>
                        <div class="products-details-lists">
                            <h2>Products Details</h2>
                            <?php echo  $row['pro_detail'] ?>
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
    </section>

    <!-- top-products-section -->
    <section class="top-products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h2>Similar Products</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="view-all">
                        <a href="#" class="view-all-text">View all <img src="./assets/images/view-all-arrow.svg" alt="view-all-arrow" /></a>
                    </div>
                </div>
            </div>
        </div>
            <div class="owl-carousel owl-theme similar-products-slider">
            <?php
                include "confing.php";
                $product_id = $_GET['id'];
                $sql1 = "SELECT category_name FROM product WHERE id='$product_id' ";
                $result1 = mysqli_query($conn,$sql1) or die("Query Feiled");
                $row1 = mysqli_fetch_assoc($result1);

                $sql2 = "SELECT id,pro_name,pro_price,pro_img FROM product WHERE category_name={$row1['category_name']} ";
                $result2 = mysqli_query($conn,$sql2) or die("Query Feiled");

                if(mysqli_num_rows($result2) > 0){
                    while($row2 = mysqli_fetch_assoc($result2)){
            ?>
                <div class="item">
                    <div class="products-wrap">
                        <div class="products-wrap-img position-relative">
                            <a href="./product-detail.php">
                                <img src="admin/Uplode/<?php echo $row2['pro_img'] ?>" alt="Product" />
                            </a>
                            <div class="product-like-cart">
                                
                                <?php 
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                    {
                                ?>
                                    <a href="./add-to-cart.php?id=<?php echo $row2['id']; ?>" class="product-btn"><img src="./assets/images/cart-white.svg" alt="Cart" /></a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="products-detail">
                            <a href="./product-detail.php">
                                <h3>Sphygmomanometer <br> (Manual Blood Preasure Monitor)</h3>
                            </a>
                            <div class="products-price-rating">
                                <p>₹688.00</p>
                                
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
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Required Login</h5>
                        </div>
                        <div class="modal-body">Please Login or create Account</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
                            <a href="./signin.php" style="background-color:#2aa1a8" type="button" class="btn btn-primary" data-mdb-ripple-init>Login</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>

<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>