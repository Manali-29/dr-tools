<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>

    <!-- cart section -->
    <section class="cart-section">
        <div class="container">
            <div class="row">
                <div class="row align-items-center listing-row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <?php 
                    include "confing.php";
                    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

                    $sql = "SELECT * FROM cart WHERE user_id = $user_id ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if (empty($row)) {
                        $result1 = Null;
                    } else {
                        $sql1 = "SELECT * FROM cart_detail WHERE cart_id = '{$row['cart_id']}' AND user_id = $user_id ";
                        $result1 = mysqli_query($conn, $sql1);
                    }
                ?>
                    <table class="table_cart product_detail_table">
                        <thead>
                          <tr class="table_cart--heading">
                            <th data-th="Products Details">Products Details</th>
                            <th data-th="Price">Price</th>
                            <th data-th="Quantity">Quantity</th>
                            <th data-th="Sub Total">Total</th>
                            <th data-th="Action">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (isset($result1) && !is_null($result1)) 
                                {
                                    if (mysqli_num_rows($result1) > 0) 
                                    {
                                        while($row1 = mysqli_fetch_assoc($result1))
                                        {
                                            $product = "SELECT * FROM product WHERE id = {$row1['pro_id']}";
                                            $pro_result = mysqli_query($conn,$product) or die("Query Feiled");
                                            $pro_row = mysqli_fetch_assoc($pro_result);
                                            $total = $row1["c_quantity"]*$pro_row['pro_price'];
                            ?>
                                <tr class="item-row">
                                    <td data-th="Products Details">
                                        <div class="products-detail-wrap">
                                            <div class="product-image-wrap">
                                                <img src="admin/Uplode/<?php echo $pro_row['pro_img'] ?>" alt="Image"/>
                                            </div>
                                            <div class="product-detail-list">
                                                <p class="p-14-dark" disabled="true"><?php echo $pro_row['pro_name'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">
                                        <div class="text-start">
                                            <span id="pro_price" class="item_price d-block p-med-18" disabled><?php echo "₹". $pro_row['pro_price'] .".00" ?></span>
                                        </div>
                                    </td>
                                    <td data-th="Quantity">
                                        <div class="qty-wrap-main">
                                            <a href="cart-remove-qty.php?id=<?php echo $pro_row['id'] ?>" style="text-decoration:none;"><span class="remove_qty">-</span></a>
                                            <input type="number" id="c_quantity" class="input_qty" min="1" name="c_quantity" value="<?php echo $row1['c_quantity'] ?>">
                                            <a href="cart-add-qty.php?id=<?php echo $pro_row['id'] ?>" style="text-decoration:none;"><span class="add_qty">+</span></a>
                                        </div>
                                    </td>
                                    <td data-th="Sub Total" id="total" class="item_cost dark-text" >
                                        <!-- <span class="item-cost-val"  disabled></span> -->
                                        <input type="text" name="" class="item-cost-val" value="<?php echo "₹". $total .".00" ?>" id="total"  disabled/>
                                    </td>
                                    <td data-th="Action"> <a href="cart-remove.php?id=<?php echo $row1['cart_detail_id'] ?>" class="js_remove_item"><img src="./assets/images/deletecon.svg" alt="Delete" /></a> </td>
                                </tr>
                            <?php 
                                        } 
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
               
                    <div class="proceed-to-checkout">
                        <div class="products-details-lists mt-0 proceed-total-wrap-main">
                            <ul>
                                <li>
                                    <p>Sub Total :</p>
                                    <p class="primary-med-18" id="sub_total" disabled><?php if (!empty($row)) {?><?php echo "₹". $row['cart_total'] .".00" ?><?php } ?></p>
                                </li>
                                
                                <!-- <li>
                                    <p>Tax :</p>
                                    <p class="red-med-18" id="tex" disabled>3.4</p>
                                </li>
                                <li>
                                    <p>GST :</p>
                                    <p class="red-med-18" id="gst" disabled>3.4</p>
                                </li> -->
                               
                                <li>
                                    <p>Grand Total :</p>
                                    <p class="primary-med-18" id="g_total" disabled><?php if (!empty($row)) {?><?php echo "₹". $row['cart_total'] .".00" ?><?php } ?></p>
                                </li>
                                <li>
                                    <div class="proceed-to-checkout-btn-wrap w-100">
                                    <?php 
                                        if (isset($row) && $row['cart_total'] != '0.00') 
                                        {
                                    ?>
                                        <a href="./checkout.php" style="text-decoration-line:none; text-align:center" type="submit" class="g-btn f-btn mb-0 w-100">Proceed To Checkout</a>
                                    <?php 
                                        } 
                                    ?>
                                    </div>
                                </li>
                            </ul>
                            <div>
                                <a href="cart-remove-all.php" class="js_remove_item remove-all-btn">Remove All</a> 
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