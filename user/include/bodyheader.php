   <style>
    .search-results-wrap 
    {
        margin-top: 15px;
        padding: 15px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        height: 150px;
        overflow-y: auto;
    }
   </style>
   <?php session_start(); ?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="./index.php">
                          <img src="./assets/images/images/logo.svg" alt="logo" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link" href="./index.php">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="./about.php">About</a>
                            </li>   
                            <li class="nav-item">
                              <a class="nav-link" href="./contact-us.php">Contact Us</a>
                            </li>     
                          </ul>
                        </div>
                        
                        <div class="header-login-wrap">
                            <?php 
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                {
                            ?>
                                <div class="link-cart-wrap login-wrap me-2">
                                    <a href="./cart.php"><img src="./assets/images/images/Cart.svg" alt="Cart" /></a>
                                    <!-- <a href=""><img src="./assets/images/Like.svg" alt="Like" /></a> -->
                                </div>

                                <div class="login-wrap me-2">
                                    <a href="./my-account.php"><img src="./assets/images/profile.svg" alt="Profile" /> <?php echo $_SESSION['first_name']; ?> </a>
                                </div>

                                <?php
                                    include "confing.php";
                                    $sql = "SELECT user_type FROM users WHERE id = {$_SESSION['id']}";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if($row['user_type'] == '0')
                                    {
                                ?>
                                        <div class="login-wrap ms-2">
                                            <a href="../admin/dashboard.php">Admin</a>
                                        </div>
                                <?php
                                    }
                                ?>

                                
                            <?php 
                                } 
                                else 
                                {
                            ?>
                                <div class="login-wrap">
                                    <a href="./signin.php"><img src="./assets/images/profile.svg" alt="Profile" /> Login </a>
                                </div>
                                <div class="login-wrap ms-3">
                                    <a href="./signup.php"><img src="./assets/images/profile.svg" alt="Profile" /> Signup </a>
                                </div>
                                <?php
                                }
                            ?>
  
                            <?php 
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
                                {
                            ?>
                                <div class="ms-2">
                                    <a href="./exit1.php" style="color:#2AA1A8"><i class="fas fa-light fa-right-from-bracket"></i></a>
                                    <!-- <a href=""><img src="./assets/images/Like.svg" alt="Like" /></a> -->
                                </div>
                            
                            <?php 
                                }
                            ?>
                        </div>       
                            <?php 
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- all-category-section -->
    <section class="all-category-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-category-wrap">
                        <div class="dropdown all-category">
                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">All Category</button>
                            <?php 
                                include "confing.php";
                                
                                if(isset($_GET['cid'])){
                                    $cat_id = $_GET['cid'];
                                }
                                

                                $sql = "SELECT * FROM category ";
                                $result = mysqli_query($conn,$sql) or die("Query Feiled : Category");
                                if(mysqli_num_rows($result) > 0){
                                    $active = "";
                                   
                            ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php  while($row = mysqli_fetch_assoc($result)){ 
                                    if(isset($_GET['cid'])){
                                        if($row['id'] == $cat_id){
                                            $active = "active";
                                        }else{
                                            $active = "";
                                        }
                                    }
                                echo "<li class='{$active}' class='nav-item dropdown'><a class='dropdown-item nav-link dropdown-toggle' href='listing-page.php?cid={$row['id']}'>{$row['cat_name']} </a> </li>";
                                } ?>
                            </ul>
                            <?php } ?>
                        </div>
                        <div class="search-wrap">
                            
                            <form action="">
                                <div class="col">
                                    <div class="row">
                                        <input type="search" class="form-control" placeholder="Search" id="search_product"/>
                                    </div>
                                    <div class="row">
                                    <div class="search-results-wrap mt-2 " id="product_list" style="display: none;"></div>
                                    </div>
                                </div>
                                <!-- <input type="submit" value="search" /> -->
                            </form>
                            <script>
                                let savedList = [];
                                $(document).ready(function(){
                                    $('#search_product').keyup(function(){
                                        var query = $(this).val();
                                        if(query != '')
                                        {
                                            $.ajax({
                                                url:"search.php",
                                                method:"POST",
                                                data:{query:query},
                                                success:function(data)
                                                {
                                                    if (savedList.length == 0)
                                                    {
                                                        savedList.push(data);
                                                    }
                                                    $('#product_list').fadeIn();
                                                    $('#product_list').html(data);
                                                }
                                            });
                                        }
                                        else 
                                        {
                                            // Clear savedList
                                            savedList = [];
                                            // Hide #product_list
                                            $('#product_list').fadeOut();
                                        }
                                    })
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>