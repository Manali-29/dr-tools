<?php include('./include/header.php') ?>
<?php
    session_start();
    include "confing.php";
?>
    <section class="section-comming-soon common-form-section overflow-hidden forgot-password-section position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="form-logo-wrap">
                        <img src="./assets/images/images/logo.svg" class="form-logo" alt="logo" />
                    </div>
                </div>
                <div class="col-xl-7 col-lg-5">
                    <div class="img-wrap">
                        <img src="./assets/images/images/signin.svg" alt="Signin" />
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['otp_email']))
                    {
                        $otp_email = $_SESSION['otp_email'];
                        
                        $check_otp = "SELECT otp FROM users WHERE email = '$otp_email'";
                        $check_otp_run = mysqli_query($conn, $check_otp);
                        $row = mysqli_fetch_array($check_otp_run);

                        if($row['otp'] == '0')
                        {
                ?>
                            <div class="col-xl-5 col-lg-7">
                                <form action="password_change.php" method="POST">
                                <?php 
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
                                                <h1>Forgot Password</h1>
                                                <p>Enter the email you use for <span>DR. TOOL</span> , and we'll help you create a new password.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="email"  name="email" class="form-control" placeholder="Enter your email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="f-btn" name="forgot">Send</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="bottom-link">
                                                <p><a href="./signin.php">Back to login</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                <?php 
                        }
                        else
                        {
                ?>
                            <div class="col-xl-5 col-lg-7">
                                <form action="verify-otp.php" method="POST">
                                    <?php 
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
                                                <h1>Verify OTP</h1>
                                                <p>Verify OTP with you have send to in email.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group password-group">
                                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                <label for="">Enter OTP</label>
                                                <input type="text" name="otp" placeholder="Enter Your OTP" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button name="verify" class="f-btn">Verify</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="bottom-link text-center">
                                                <p class="text-center mt-lg-4">Return to Vocaal4local's? <a href="./signin.php">Back to login</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                <?php 
                        }
                    }
                    else
                    {
                ?>
                            <div class="col-xl-5 col-lg-7">
                                <form action="password_change.php" method="POST">
                                <?php 
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
                                                <h1>Forgot Password</h1>
                                                <p>Enter the email you use for <span>DR. TOOL</span> , and we'll help you create a new password.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="email"  name="email" class="form-control" placeholder="Enter your email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="f-btn" name="forgot">Send</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="bottom-link">
                                                <p><a href="./signin.php">Back to login</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
<?php include('./include/footer.php') ?>