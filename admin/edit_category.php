<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active"><a href="manage_category.php">Manage Category</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Edit Category</h5>

                        <?php
                            include "confing.php";
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM category WHERE id = {$id}";
                            $result = mysqli_query($conn,$sql) or die("Query Feiled");
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <form class="row g-3" action="save_category.php" method="post" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="id" value="<?php echo $row['id']; ?>" disabled >
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                                    <label for="cat_id">Category Id :</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cat_name" name="cat_name" value="<?php echo $row['cat_name']; ?>" placeholder="Enter Category Name">
                                    <label for="category_name">Category Name</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="cat_icon" name="cat_icon">
                                    <img src="Uplode/<?php echo $row['cat_icon'] ?>" height="150px">
                                    <input type="hidden" name="old_image" value="<?php echo $row['cat_icon'] ?>">
                                </div>
                            </div>
                
                            <div class="text-center">
                                <button type="submit" class="btn" style="background-color: #2aa1a8;">Update Category</button>
                            </div>
                        </form>
                        <?php
                                }
                            }else{
                                echo "Result Not Found.";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('../admin/include/footer.php') ?>