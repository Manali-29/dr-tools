<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active"><a href="manage_category.php">Manage Category</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Manage Category</h5><hr>
                        <?php 
                            
                            include "confing.php";
                        
                            $sql = "SELECT * FROM category ORDER BY id DESC";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                        ?>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Name</th>
                                    <th>Product </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['cat_name']; ?></td>
                                    <td><?php echo $row['product_count']; ?> </td>
                                    <td><a href="edit_category.php?id=<?php echo $row['id']; ?>" class="me-3"><img src="../assets/images/images/edit.svg" alt="Edit" /></a>
                                    <a href="delete_category.php?id=<?php echo $row['id']; ?>" class=""><img src="../assets/images/deletecon.svg" alt="Delete" /></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>