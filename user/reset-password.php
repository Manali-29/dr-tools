<?php include('./include/header.php') ?>
<?php
    session_start();
    
    if(isset($_POST['save']))
    {
        $password = $_POST['password'];
        $new_password = md5($password);
        $email = $_SESSION['otp_email'];
        
        include "confing.php";
        
        $update = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
        $update_query =  mysqli_query($conn, $update);

        header("Location: signin.php");
        exit();
    }
?>
    <section class="section-comming-soon common-form-section overflow-hidden reset-pass forgot-password-section position-relative">
        
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
                    <form action="reset-password.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-title">
                                    <h1>Reset Password</h1>
                                    <p>Choose a password that's unique to this account.</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group password-group">
                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    <label for="">Create New Password</label>
                                    <input type="password" name="password" placeholder="Enter a new password" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group password-group">
                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="f-btn" name="save">Save</button>
                            </div>
                            <div class="col-lg-12">
                                <div class="bottom-link text-center">
                                    <p class="text-center mt-lg-4">Return to Vocaal4local's? <a href="./signin.php">Back to login</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include('./include/footer.php') ?>