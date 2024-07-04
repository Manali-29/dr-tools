<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>
<?php include "confing.php" ?>

<?php 
    /* coded by Rahul Barui ( https://github.com/Rahul-Barui ) */
    include "confing.php";
    if(isset($_POST['online_payment'])){
        $cart_id = $_POST['cart_id'];
    } elseif (isset($_POST['product_online_payment'])) {
        $product_id = $_POST['id'];
    } else {
        $cart_id = '';
    }

    $id = $_SESSION['id'];
    $user = "SELECT * FROM users WHERE id={$id} ";
    $user_result = mysqli_query($conn,$user) or die("Query Feiled");
    $user_row = mysqli_fetch_assoc($user_result);

    if(isset($_POST['online_payment'])){
        $cart_sql = "SELECT * FROM cart WHERE cart_id={$cart_id} ";
        $cart_result = mysqli_query($conn,$cart_sql) or die("Query Feiled");
        $cart_row = mysqli_fetch_assoc($cart_result);
        $total = $cart_row['cart_total'];
    } elseif (isset($_POST['product_online_payment'])) {
        $product = "SELECT * FROM product WHERE id = {$product_id}";
        $pro_result = mysqli_query($conn,$product) or die("Query Feiled");
        $pro_row = mysqli_fetch_assoc($pro_result);
        $total = $pro_row["pro_price"];
    }

    // $cart_detail_sql = "SELECT * FROM cart_detail WHERE cart_id = {$cart_id} ";
    // $cart_detail_result = mysqli_query($conn,$cart_detail_sql) or die("Query Feiled");
    // if(mysqli_num_rows($cart_detail_result) > 0)
    // {
    //     while($cart_detail_row = mysqli_fetch_assoc($cart_detail_result))
    //     {
    //         $product = "SELECT * FROM product WHERE id = {$cart_detail_row['pro_id']}";
    //         $pro_result = mysqli_query($conn,$product) or die("Query Feiled");
    //         $pro_row = mysqli_fetch_assoc($pro_result);
    //         $total = $cart_detail_row["c_quantity"]*$pro_row['pro_price'];
    //         echo $total;
    //     }
    // }

    // $SQL_getPr = "SELECT * FROM `products` WHERE `id`='$productId'";
    // $res_getPr = mysqli_query($con,$SQL_getPr) or die("MySql Query Error".mysqli_error($con));
    // $row_getPr = mysqli_fetch_assoc($res_getPr);
    // $price = $row_getPr['price'];
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">

            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td"> &nbsp;Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>

                <div class="panel-body">

                    <!-- Display errors returned by createToken -->
                    <div class="payment-status" style="color: red;"></div>

                    <!-- Payment form -->
                    <?php
                        if(isset($_POST['online_payment'])){
                    ?>
                        <form role="form" action="stripe_payment.php" method="POST" name="cardpayment" id="payment-form">
                            <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
                            <input type="hidden" name="price" value="<?php echo $total;?>"/>
                            <input type="hidden" name="cart_id" value="<?php echo $cart_id;?>"/>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="couponCode">CARD HOLDER NAME</label>
                                        <input type="text" class="form-control" name="holdername" value="<?php echo $user_row['first_name'];?> <?php echo $user_row['last_name'];?>" placeholder="Enter Card Holder Name" autofocus required id="name" />
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="couponCode">EMAIL</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $user_row['email'];?>" placeholder="Email" id="email" required />
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="visible-xs-inline">MON</span></label>
                                        <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
                                            <option>MON</option>
                                            <option value="01">01 ( JAN )</option>
                                            <option value="02">02 ( FEB )</option>
                                            <option value="03">03 ( MAR )</option>
                                            <option value="04">04 ( APR )</option>
                                            <option value="05">05 ( MAY )</option>
                                            <option value="06">06 ( JUN )</option>
                                            <option value="07">07 ( JUL )</option>
                                            <option value="08">08 ( AUG )</option>
                                            <option value="09">09 ( SEP )</option>
                                            <option value="10">10 ( OCT )</option>
                                            <option value="11">11 ( NOV )</option>
                                            <option value="12">12 ( DEC )</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="visible-xs-inline">YEAR</span></label>
                                        <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year">
                                            <option>Year</option>
                                            <option value="20">2020</option>
                                            <option value="21">2021</option>
                                            <option value="22">2022</option>
                                            <option value="23">2023</option>
                                            <option value="24">2024</option>
                                            <option value="25">2025</option>
                                            <option value="26">2026</option>
                                            <option value="27">2027</option>
                                            <option value="28">2028</option>
                                            <option value="29">2029</option>
                                            <option value="30">2030</option>
                                            <option value="31">2031</option>
                                            <option value="32">2032</option>
                                            <option value="33">2033</option>
                                            <option value="34">2034</option>
                                            <option value="35">2035</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="subscribe btn btn-success btn-lg btn-block submit" type="submit" id="payBtn">PAY NOW ( ₹<?php echo $total;?> )</button>
                                </div>
                            </div>
                        </form>
                    <?php
                        } elseif (isset($_POST['product_online_payment'])) {
                    ?>
                        <form role="form" action="product_stripe_payment.php" method="POST" name="cardpayment" id="payment-form">
                            <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
                            <input type="hidden" name="price" value="<?php echo $total;?>"/>
                            <input type="hidden" name="product_id" value="<?php echo $product_id;?>"/>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="couponCode">CARD HOLDER NAME</label>
                                        <input type="text" class="form-control" name="holdername" value="<?php echo $user_row['first_name'];?> <?php echo $user_row['last_name'];?>" placeholder="Enter Card Holder Name" autofocus required id="name" />
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="couponCode">EMAIL</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $user_row['email'];?>" placeholder="Email" id="email" required />
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="visible-xs-inline">MON</span></label>
                                        <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
                                            <option>MON</option>
                                            <option value="01">01 ( JAN )</option>
                                            <option value="02">02 ( FEB )</option>
                                            <option value="03">03 ( MAR )</option>
                                            <option value="04">04 ( APR )</option>
                                            <option value="05">05 ( MAY )</option>
                                            <option value="06">06 ( JUN )</option>
                                            <option value="07">07 ( JUL )</option>
                                            <option value="08">08 ( AUG )</option>
                                            <option value="09">09 ( SEP )</option>
                                            <option value="10">10 ( OCT )</option>
                                            <option value="11">11 ( NOV )</option>
                                            <option value="12">12 ( DEC )</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span class="visible-xs-inline">YEAR</span></label>
                                        <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year">
                                            <option>Year</option>
                                            <option value="20">2020</option>
                                            <option value="21">2021</option>
                                            <option value="22">2022</option>
                                            <option value="23">2023</option>
                                            <option value="24">2024</option>
                                            <option value="25">2025</option>
                                            <option value="26">2026</option>
                                            <option value="27">2027</option>
                                            <option value="28">2028</option>
                                            <option value="29">2029</option>
                                            <option value="30">2030</option>
                                            <option value="31">2031</option>
                                            <option value="32">2032</option>
                                            <option value="33">2033</option>
                                            <option value="34">2034</option>
                                            <option value="35">2035</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="subscribe btn btn-success btn-lg btn-block submit" type="submit" id="payBtn">PAY NOW ( ₹<?php echo $total;?> )</button>
                                </div>
                            </div>
                        </form>
                    <?php
                        }
                    ?>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
    
        </div>

        <div class="col-xs-12 col-md-4">
            <h2>Test Card Number Details</h2>
            <p>To test the payment process, you need test card details. Use any of the following test card numbers - </p>
                <ul>
                    <li>A valid future expiration date.</li>
                    <li>Any random CVC number</li>
                </ul>
                <!--<p>To test Stripe payment gateway integration in PHP</p>-->
            <table class="tutorial-table" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <th>Card Number</th>
                    <th>Brand Name</th>
                </tr>
                <tr>
                    <td>4242424242424242</td>
                    <td>Visa</td>
                </tr>
                <tr>
                    <td>4000056655665556</td>
                    <td>Visa (debit)</td>
                </tr>
                <tr>
                    <td>5555555555554444</td>
                    <td>Mastercard</td>
                </tr>
                <tr>
                    <td>5200828282828210</td>
                    <td>Mastercard (debit)</td>
                </tr>
                <tr>
                    <td>378282246310005</td>
                    <td>American Express</td>
                </tr>
                <tr>
                    <td>6011111111111117</td>
                    <td>Discover</td>
                </tr>
                <tr>
                    <td>6200000000000005</td>
                    <td>UnionPay</td>
                </tr>
            </table>
        </div>

    </div>
</div>
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>