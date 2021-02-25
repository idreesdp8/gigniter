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
                    <?php if ($this->session->flashdata('success_msg')) { ?>
                        <div class="alert alert-success no-border">
                            <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
                            <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                    <?php }
                    if ($this->session->flashdata('error_msg')) { ?>
                        <div class="alert alert-danger no-border">
                            <!-- <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button> -->
                            <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                    <?php } ?>
                    <div class="section-header-3">
                        <span class="cate">welcome</span>
                        <h2 class="title">to Gigniter </h2>
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/signup'); ?>" method="post">
                        <div class="form-group">
                            <label for="email1">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" name="email" id="email" data-error="#email1" required>
                            <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pass1">Password<span>*</span></label>
                            <input type="password" placeholder="Password" name="password" id="password" data-error="#password1" required>
                            <span id="password1" class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pass2">Confirm Password<span>*</span></label>
                            <input type="password" placeholder="Password" name="confirm_password" id="confirm_password" data-error="#confirm_password1" required>
                            <span id="confirm_password1" class="text-danger"><?php echo form_error('confirm_password'); ?></span>
                        </div>
                        <div class="form-group checkgroup">
                            <div class="agree_box">
                                <input id="agree_box" type="checkbox" checked>
                                <label for="agree_box" class="agree_label">I agree to the <a href="#0">Terms, Privacy Policy</a> and <a href="#0">Fees</a></label>
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input class="sub_btn" type="submit" value="Sign Up">
                        </div>
                    </form>
                    <div class="option">
                        Already have an account? <a href="<?php echo user_base_url() ?>login">Login</a>
                    </div>
                    <div class="or"><span>Or</span></div>
                    <ul class="social-icons">
                        <li>
                            <a href="#0">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#0" class="active">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#0">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->


    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>

    <script>
        $(document).ready(function() {
            var validator = $('#datas_form').validate({
                rules: {
                    password: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Password is required field"
                    },
                    email: {
                        required: "Email is required field",
                        email: "Please enter a valid Email address!"
                    },
                    confirm_password: {
                        required: "Confirm Password is required field",
                        equalTo: "Both passwords should match"
                    }
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function() {
                    document.forms["datas_form"].submit();
                }
            });
        });
    </script>
</body>

</html>