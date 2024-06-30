<?php include('./include/header.php') ?>
<?php include('./include/bodyheader.php') ?>
    <!-- product-detail-section -->
    <section class="product-detail-section contact-section">
        <div class="container">
            <div class="row">
                <div class="row align-items-center listing-row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-12">
                        <div class="common-form-section cmn-bg-tab services-inquiry-wrap">
                            <h1>Get In Touch</h1>
                            
                            <form action="message.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Full Name*</label>
                                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your name" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Email Address*</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Contact Number*</label>
                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="0000000000" value="" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==10) return false;" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Message*</label>
                                            <textarea  cols="30" rows="2" class="form-control" name="message" id="message" placeholder="Write a message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center buttons-wrap">
                                    <button type="submit" id="feed" name="feed" class="g-btn f-btn mb-0 radius-3">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="img-wrap-wrap">
                            <img src="./assets/images/images/contact.png" alt="" />
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
<?php include('./include/bodyfooter.php') ?>
<?php include('./include/footer.php') ?>