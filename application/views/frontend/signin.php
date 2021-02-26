<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>

</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>

    <!-- ==========Sign-In-Section========== -->
    <section class="account-section ">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <?php $this->load->view('alert/alert'); ?>
                    <div class="section-header-3">
                        <span class="cate">hello</span>
                        <h2 class="title">welcome back</h2>
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/signin'); ?>" method="post">
                        <div class="form-group">
                            <label for="email2">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" name="email" id="email" data-error="#email1" required>
                            <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pass3">Password<span>*</span></label>
                            <input type="password" placeholder="Password" name="password" id="password" data-error="#password1" required>
                            <span id="password1" class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="form-group checkgroup remember_group">
                            <div class="remember_box">
                                <input id="remember_box" type="checkbox" checked>
                                <label for="remember_box" class="remember_label">remember password</label>
                                <span></span>
                            </div>
                            <a href="<?php echo user_base_url() ?>recover_password" class="forget-pass">Forget Password</a>
                        </div>
                        <div class="form-group text-center">
                            <input class="sub_btn" type="submit" value="log in">
                        </div>
                    </form>
                    <div class="option">
                        Don't have an account? <a href="<?php echo user_base_url() ?>register">sign up now</a>
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
            $('#signin_menu').addClass('active');
            var validator = $('#datas_form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required field",
                        email: "Please enter a valid Email address!"
                    },
                    password: {
                        required: "Password is required field"
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