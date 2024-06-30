<?php include('./include/header.php') ?>

    <section class="section-comming-soon common-form-section overflow-hidden position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="logo-signup">
                       <a href="./index.php"> <img src="./assets/images/images/logo.svg" alt="Logo" /></a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-5">
                    <div class="img-wrap">
                        <img src="./assets/images/images/signin.svg" alt="Signin" />
                    </div>
                </div>
                <div class="col-xl-5 col-lg-7">
                    <form action="./new2.php" method="POST">
                        <?php
                            session_start(); 
                            if(isset($_SESSION['status']))
                            {
                        ?>
                                <div class="alert alert-danger">
                                    <h5><?php echo $_SESSION['status']; ?></h5>
                                </div>
                        <?php
                                unset($_SESSION['status']);
                            }
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-title">
                                    <p>Welcome</p>
                                    <h1>Log In</h1>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email"/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group password-group">
                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Password" class="form-control" id="password" name="password"/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <a href="./forgot-password-page.php" class="fp-link">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="f-btn" id="login" name="login">Log In</button>
                            </div>
                            <div class="col-lg-12">
                                <div class="bottom-link">
                                    <p>No Account?  <a href="./signup.php">Create Account</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include('./include/footer.php') ?>