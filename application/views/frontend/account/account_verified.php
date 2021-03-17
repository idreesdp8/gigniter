<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        .account-area .account-form .form-group input {
            color: black !important;
        }
    </style>

</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>

    <!-- ==========Sign-In-Section========== -->
    <section class="account-section">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <!-- <span class="cate">welcome</span> -->
                        <h6>Your Account has been Verified!</h6>
                        <div class="form-group text-center">
                            <a href="<?php echo user_base_url();  ?>" type="button" class="btn btn-primary">Main Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->


    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
</body>

</html>