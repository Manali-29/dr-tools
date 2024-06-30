<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Payment</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Manage Payment</h5><hr>
                        <?php 
                           // $conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();
                            include "confing.php";
                            $sql = "SELECT p.payment_id, p.payment_method, p.order_id, p.payment_amount, p.payment_ststus, p.payment_date, p.user_id, o.order_id FROM payment as p inner JOIN `order` as o ON p.order_id = o.order_id";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0)
                            {
                        ?>
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Payment Id</th>
                                            <th>Order Id</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['payment_id']; ?></td>
                                                    <td><?php echo $row['order_id']; ?></td>
                                                    <td><?php echo $row['payment_ststus']; ?></td>
                                                    <td><a href="view_payment.php?id=<?php echo $row['payment_id']; ?>" class="me-3"><img src="../assets/images/images/view.svg" style="height: 16px;width: 16px;" alt="View"/></a>
                                                    <a href="delete_payment.php?payment_id=<?php echo $row['payment_id']; ?>" class="js_remove_item"><img src="../assets/images/deletecon.svg" alt="Delete" /></a></td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>