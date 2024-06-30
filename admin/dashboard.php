<?php include('../admin/include/header.php') ?>
<?php include('../admin/include/sidebar.php') ?>
<?php include "confing.php"; ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="manage_user.php"><i class="fas fa-user"></i></a>
                  </div>
                  <div class="ps-3">
                  <?php
                    $sql = "SELECT COUNT(*) AS total FROM users";
                    $result = mysqli_query($conn,$sql) or die("Query Feiled");
                    $row = mysqli_fetch_assoc($result);
                  ?>
                    <h6><?php echo $row['total']; ?></h6>
                  <?php
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Product</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="manage_product.php"><i class="fas fa-light fa-cart-plus"></i></a>
                  </div>
                  <div class="ps-3">
                  <?php
                    $sql1 = "SELECT COUNT(*) AS pro_total FROM product";
                    $result1 = mysqli_query($conn,$sql1) or die("Query Feiled");
                    $row1 = mysqli_fetch_assoc($result1);
                  ?>
                    <h6><?php echo $row1['pro_total']; ?></h6>
                  <?php
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Total Category</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="manage_category.php"><i class="fas fa-light fa-layer-group"></i></a>
                  </div>
                  <div class="ps-3">
                  <?php
                    $sql2 = "SELECT COUNT(*) AS cat_total FROM category";
                    $result2 = mysqli_query($conn,$sql2) or die("Query Feiled");
                    $row2 = mysqli_fetch_assoc($result2);
                  ?>
                    <h6><?php echo $row2['cat_total']; ?></h6>
                  <?php
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Customers Card -->
          
          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="manage_order.php"><i class="fas fa-light fa-layer-group"></i></a>
                  </div>
                  <div class="ps-3">
                  <?php
                    $sql3 = "SELECT COUNT(*) AS order_total FROM `order`";
                    $result3 = mysqli_query($conn,$sql3) or die("Query Feiled");
                    $row3 = mysqli_fetch_assoc($result3);
                  ?>
                    <h6><?php echo $row3['order_total']; ?></h6>
                  <?php
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Customers Card -->
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>

  </main><!-- End #main -->
<?php include('../admin/include/footer.php') ?>