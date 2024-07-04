<?php 
    include "confing.php";
	session_start();

	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['holdername'];
		$email = $_POST['email'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$price = $_POST['price'];
		$usd_amount = round($price / 83.49);
		$cart_id = $_POST['cart_id'];
		$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

		// Get Product ID From - Form
		// $productId = $_POST['productId'];

		// Get Product Details By Using Product-Id
		// $SQL_getPr = "SELECT * FROM `products` WHERE `id`='$productId'";
	    // $res_getPr = mysqli_query($con,$SQL_getPr) or die("MySql Query Error".mysqli_error($con));
	    // $row_getPr = mysqli_fetch_assoc($res_getPr);
	    // $price = $row_getPr['price'];
	    // $pr_desc = $row_getPr['name'];

		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51PYTuoEbTleRjPfD4RNnsAqIKqH2Z7DZsL3gX1H5bGzP7aCKJEoQbxf0WZCcjLrjCamS3WjsyI1BxiSmGQ04fhlg00H4BpGcAR",
		"PublishableKey"=>"pk_test_51PYTuoEbTleRjPfD16ZAUX3HPdaoxlqBHUByK9gLOIRotdCVjvLSxXEt1uXsl4pPIHO16JHz2Ljhj9WThVMbHent00zp0ZmDWE"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>'Your order is done'
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = ($usd_amount*100);
	    $currency = "usd";
	    // $itemName = $row_getPr['name'];

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => 'Your order is done', 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['balance_transaction']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database

			$sql = "SELECT * FROM cart WHERE user_id = {$user_id}";
        	$result = mysqli_query($conn, $sql);
        	$row = mysqli_fetch_assoc($result);
    		$total = $row['cart_total'];

			$sql1 = "INSERT INTO `order` (cart_id, sub_total, order_status,card_number,card_exp_month,card_exp_year,transactionID,payment_status,user_id) VALUES ('{$cart_id}', '{$total}', 'approved','$card_no','$card_exp_month','$card_exp_year','$transactionID','$payment_status','{$user_id}')";
        	$result1 = mysqli_query($conn, $sql1);

        	$order_id = mysqli_insert_id($conn);

        	$sql2 = "SELECT * FROM cart_detail WHERE cart_id = '{$row['cart_id']}'";
        	$result2 = mysqli_query($conn, $sql2);

        	while($row1 = mysqli_fetch_assoc($result2))
        	{
            	$sql3 = "INSERT INTO order_detail (pro_id, order_qty, order_id) VALUES ('{$row1['pro_id']}', '{$row1['c_quantity']}', '{$order_id}')";
            	$result3 = mysqli_query($conn, $sql3);

            	$sql5 = "SELECT quantity FROM product WHERE id = {$row1['pro_id']}";
            	$result5 = mysqli_query($conn, $sql5);

            	$row2 = mysqli_fetch_assoc($result5);
            	$new_qty = $row2['quantity'] - $row1['c_quantity'];

            	$sql6 = "UPDATE product SET quantity = $new_qty WHERE id = {$row1['pro_id']}";
            	$result6 = mysqli_query($conn, $sql6);
        	}

        	$sql4 = "INSERT INTO payment (payment_method, order_id, payment_amount, user_id) VALUES ('Online', '{$order_id}', '{$total}', '{$user_id}')";
        	$result4 = mysqli_query($conn, $sql4);

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

	        // $sql = "INSERT INTO `orders`(`name`,`email`,`card_number`,`card_exp_month`,`card_exp_year`,`item_name`,`item_number`,`item_price`,`item_price_currency`,`paid_amount`,`paid_amount_currency`,`txn_id`,`payment_status`,`created`,`modified`) VALUES ('$name','$email','$card_no','$card_exp_month','$card_exp_year','$itemName','','$itemPrice','$currency','$paidAmount','$paidCurrency','$transactionID','$payment_status','$dt_tm','$dt_tm')";
	        // mysqli_query($con,$sql) or die("Mysql Error Stripe-Charge(SQL)".mysqli_error($con));

    		// Get Last Id
    		$sql_g = "SELECT * FROM `order`";
    		$res_g = mysqli_query($conn,$sql_g) or die("Mysql Error Stripe-Charge(SQL2)".mysqli_error($conn));
    		while($row_g=mysqli_fetch_assoc($res_g)){
    			$id = $row_g['order_id'];
    		}

	        // If the order is successful 
	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html>
	<head>
        <title> DrTools </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../user/assets/css/style.css">
    </head>

    <div class="container">
        <h2 style="text-align: center; color: blue;">DrTools Payment</h2>
        <h4 style="text-align: center;">This is - DrTools Payment Success URL </h4>
        <br>
        <div class="row">
	        <div class="col-lg-12">
				<div class="status">
					<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
				
					<h4 class="heading">Payment Information - </h4>
					<br>
					<p><b>Reference ID:</b> <strong><?php echo $id; ?></strong></p>
					<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
					<p><b>Paid Amount:</b> ₹<?php echo $price;?>.00</p>
					<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
				</div>
				<a href="index.php" class="btn-continue">Back to Home</a>
			</div>
		</div>
	</div>
</html>