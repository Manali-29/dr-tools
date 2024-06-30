<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Payament View</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
          <li class="breadcrumb-item"><a href="manage_payment.php">Manage Payment</a></li>
          <li class="breadcrumb-item active"> View Payment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="col-lg-12">
        <div class="billing-details-main order-summary-wrap">
            <div class="billing-details-wrap">
                <div class="table-wrap">
                    <?php  
                        include "confing.php";
                        $payment_id = $_GET['id'];
                        $sql = "SELECT * FROM payment WHERE payment_id = {$payment_id}";
                        $result = mysqli_query($conn,$sql) or die("Query Feiled");
                        if(mysqli_num_rows($result) > 0)
                        {
                    ?>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Payment Id</th>
                                        <th>Payment Method</th>
                                        <th>Order Id</th>
                                        <th>Total Payment Amount</th>
                                        <th>Payment Status</th>
                                        <th>Payment Date</th>
                                        <th>User Id</th>
                                        <th>Update Status</th>
                                    </tr>
                                </thead>
                                <?php 
                                    while($row = mysqli_fetch_assoc($result))
                                    { 
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td><p><?php echo $row['payment_id']; ?></p></td>
                                                <td><p><?php echo $row['payment_method']; ?></p></td>
                                                <td><p><?php echo $row['order_id']; ?></p></td>
                                                <td><p>₹<?php echo $row['payment_amount']; ?>.00</p></td>
                                                <td><p><?php echo $row['payment_ststus']; ?></p></td>
                                                <td><p><?php echo $row['payment_date']; ?></p></td>
                                                <td><p class="dark-text"><?php echo $row['user_id']; ?></p></td>
                                                <td>
                                                    <div  class="btn" style="background-color:#7dc6ba;" >
                                                        <a class="login-wrap ms-2" style="color:white;" href="./status-update.php?id=<?php echo $row['payment_id']; ?>" >
                                                            <span>Update</span>
                                                        </a>
                                                    </div >
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php 
                                        }
                                    ?>
                            </table>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include('../admin/include/footer.php') ?>
</html>