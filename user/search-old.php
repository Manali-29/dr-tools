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
                
                <div class="col-xl-9 col-lg-8 col-md-12 sidebar-menu">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                        <div class="products-wrap">
                        <div class="products-wrap-img position-relative">
                            <a href="./product-detail.php">
                                <img src="./assets/images/images/pulse-oximeter_2.jpg" alt="Product" />
                            </a>
                            <div class="product-like-cart">
                                <a href="#" class="product-btn"><img src="./assets/images/like-white.svg" alt="Like" /></a>
                                <a href="#" class="product-btn"><img src="./assets/images/cart-white.svg" alt="Cart" /></a>
                            </div>
                        </div>
                        <div class="products-detail">
                            <a href="./product-detail.php">
                                <h3>Pulse Oximeter</h3>
                            </a>
                            <div class="products-price-rating">
                                <p>₹389.00</p>
                                <div class="rating-wrap">
                                    <a href="#">
                                        <img src="./assets/images/star.svg" alt="Star" />
                                        <img src="./assets/images/star.svg" alt="Star" />
                                        <img src="./assets/images/star.svg" alt="Star" />
                                        <img src="./assets/images/star.svg" alt="Star" />
                                        <img src="./assets/images/star.svg" alt="Star" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>