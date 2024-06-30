<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>
<?php include "confing.php" ?>
    <!-- cart section -->
    <section class="cart-section checkout-section">
        <div class="container">
            <div class="row">
                <div class="row align-items-center listing-row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item"><a href="./cart.php">Cart</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="billing-details-main">
                        <h1>Billing Details</h1>
                        <div class="billing-details-wrap">
                            <div class="change-wrap">
                                <span>DEFAULT</span>
                                <p class="deliver-text">Deliver to: <span><?php echo $_SESSION['first_name'];?> <?php echo $_SESSION['last_name'];?></span> </p>
                                <?php 
                                    $id = $_SESSION['id'];
                                    
                                    $sql = "SELECT address,postal_code FROM users WHERE id={$id} ";
                                    $result = mysqli_query($conn,$sql) or die("Query Feiled");
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?> 
                                            <p class="reg-14-gray"><?php echo $row['address']?>-<?php echo $row['postal_code']?></p>
                                <?php 
                                        }
                                    }        
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="billing-details-main order-summary-wrap">
                        <h2>Order Summary</h2>
                        <div class="billing-details-wrap">
                            <div class="table-wrap">
                                <table class="table mb-0">
                                    <tbody>
                                        <?php 
                                            $id = $_SESSION['id'];
                                    
                                            $cart_sql = "SELECT * FROM cart WHERE user_id={$id} ";
                                            $cart_result = mysqli_query($conn,$cart_sql) or die("Query Feiled");
                                            $cart_row = mysqli_fetch_assoc($cart_result);

                                            $cart_detail_sql = "SELECT * FROM cart_detail WHERE cart_id = {$cart_row['cart_id']} ";
                                            $cart_detail_result = mysqli_query($conn,$cart_detail_sql) or die("Query Feiled");
                                            if(mysqli_num_rows($cart_detail_result) > 0)
                                            {
                                                while($cart_detail_row = mysqli_fetch_assoc($cart_detail_result))
                                                {
                                                    $product = "SELECT * FROM product WHERE id = {$cart_detail_row['pro_id']}";
                                                    $pro_result = mysqli_query($conn,$product) or die("Query Feiled");
                                                    $pro_row = mysqli_fetch_assoc($pro_result);
                                                    $total = $cart_detail_row["c_quantity"]*$pro_row['pro_price'];
                                        ?>
                                                <tr class="alert" role="alert">
                                                    <td>
                                                        <div class="products-detail-wrap">
                                                            <div class="product-image-wrap">
                                                                <img src="admin/Uplode/<?php echo $pro_row['pro_img'] ?>" alt="">
                                                            </div>
                                                            <div class="product-detail-list">
                                                                <p class="p-14-dark"><?php echo $pro_row['pro_name'] ?></p>
                                                                <!-- <p class="p-14-dark"> <span class="span-title">Color:</span> <span>White</span></p> -->
                                                            </div>
                                                        </div>
                                                    
                                                    </td>
                                                    <td>
                                                        <div class="product-price-wrap text-end qty-wrap">
                                                            <p class="dark-text">₹<?php echo $cart_detail_row['price']?>/item</p>
                                                            <p class="p-14-dark"> <span class="span-title">Qty : </span>  <span> <?php echo $cart_detail_row['c_quantity']?> </span></p>
                                                            <p class="dark-text mt-2">₹<?php echo $total; ?></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php 
                                                }
                                            }
                                        ?>
                                        <tr class="alert" role="alert">
                                            <td>
                                                <div class="main-dis">
                                                    <p class="light-text">Grand Total :</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="main-dis main-dis-2">
                                                    <p class="dark-text text-success">₹<?php echo $cart_row['cart_total']?>.00</p>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="payment-wrapper">
                                                    <h3>Payment Method</h3>
                                                    <!-- <p>All transactions are secure and encrypted.</p> -->
                                                    <div class="checkbox-wrap text-center card-cod-wrap mb-2">
                                                        <div class="form-group">
                                                            <input type="radio" id="cod" name="radio-group" checked="">
                                                            <label for="cod">Cash on delivery</label>
                                                            <p>Pay with cash on delivery.</p>
                                                        </div>
                                                        <div class="text-center buttons-wrap w-100">
                                                            <form action="place_order.php" method="POST">
                                                                <input type="text" name="cart_id" value="<?php echo $cart_row['cart_id']?>" hidden>
                                                                <button type="submit" name="place_order" class="g-btn f-btn mb-0 w-100">Place Order</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>