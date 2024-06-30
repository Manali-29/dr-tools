<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="manage_contact_us.php">Manage Contact Us</a></li>
                <li class="breadcrumb-item active">View Message</li>
            </ol>
        </nav>
    </div>
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">View Message</h5>
                        <?php 
                            include "confing.php";
                            $id = $_GET['message_id'];  
                            $sql = "SELECT * FROM contactus WHERE message_id = {$id}";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <form class="row g-3">
                            
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="hidden" class="form-control" id="message_id" value="<?php echo $row['message_id']; ?>">
                                    <input type="text" class="form-control" id="message_id" value="<?php echo $row['message_id']; ?>" disabled>
                                    <label for="category_name">Message Id :</label>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="full_name" value="<?php echo $row['full_name']; ?>" disabled>
                                    <label for="category_name">User Name :</label>
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
                                    <input type="text" class="form-control" id="phone" value="<?php echo $row['phone']; ?>" disabled>
                                    <label for="category_name">Phone_No :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="massege" value="" disabled ><?php echo $row['message']; ?></textarea>
                                    <label for="category_name">Massege :</label>
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