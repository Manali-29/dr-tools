<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="manage_user.php">Manage User</a></li>
                <li class="breadcrumb-item active">View User</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">View User Details</h5>
                        <?php 
                            include "confing.php";
                            $id = $_GET['id'];  
                            $sql = "SELECT * FROM users WHERE id = {$id}";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <form class="row g-3">

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="user_id" value="<?php echo $row['id']; ?>" disabled>
                                    <label for="category_name">User Id :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="first_name" value="<?php echo $row['first_name']; ?>" disabled>
                                    <label for="category_name">First Name :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>" disabled>
                                    <label for="category_name">Last Name :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" value="<?php echo $row['email']; ?>" disabled>
                                    <label for="category_name">Email :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone_no" value="<?php echo $row['phone_no']; ?>" disabled>
                                    <label for="category_name">Phone_No :</label>
                                </div>
                            </div>

                            <!-- <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="gender" value="<?php echo $row['gendr']; ?>" disabled>
                                    <label for="category_name">Gender :</label>
                                </div>
                            </div> -->

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="dob" value="<?php echo $row['dob']; ?>" disabled>
                                    <label for="category_name">Date of Birth :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="address"  disabled ><?php echo $row['address']; ?></textarea>
                                    <label for="category_name">User Address :</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn" style="background-color: #2aa1a8;">Go Back</button>
                            </div>
                        </form>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>