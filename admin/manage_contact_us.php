<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Contact Us
                </li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Manage Contact Us</h5><hr>
                        <?php 
                            //$conn = mysqli_connect('localhost', 'root', '', 'drtools') or die("Connection Faild") . mysqli_connect_error();
                            include "confing.php";
                            $sql = "SELECT * FROM contactus";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                        ?>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    
                                    <th>Message Id</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>phone Number</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                   
                                    <td><?php echo $row['message_id']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo substr($row['message'],0,10) . "..."; ?></td>
                                    <td><a href="view_message.php?message_id=<?php echo $row['message_id']; ?>" class="me-3"><img src="../assets/images/images/view.svg" style="height: 16px;width: 16px;" alt="Edit"/></a>
                                    <a href="delete_message.php?message_id=<?php echo $row['message_id']; ?>" class=""><img src="../assets/images/deletecon.svg" alt="Delete" /></a></td>
                                </tr>
                                <?php } ?>
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