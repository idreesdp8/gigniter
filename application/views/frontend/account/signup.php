<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>

</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>

    <!-- ==========Sign-In-Section========== -->
    <section class="account-section">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <?php $this->load->view('alert/alert'); ?>
                    <div class="section-header-3">
                        <span class="theme-primary-color cate">welcome</span>
                        <h2 class="title">to Gigniter </h2>
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/signup'); ?>" method="post">
                        <div class="form-group">
                            <label for="fname1">First Name<span>*</span></label>
                            <input type="text" placeholder="Enter Your First Name" value="<?php echo set_value('fname') ?>" name="fname" id="fname" data-error="#fname1" required>
                            <span id="fname1" class="text-danger"><?php echo form_error('fname'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="lname1">Last Name<span>*</span></label>
                            <input type="text" placeholder="Enter Your Last Name" value="<?php echo set_value('lname') ?>" name="lname" id="lname" data-error="#lname1" required>
                            <span id="lname1" class="text-danger"><?php echo form_error('lname'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email1">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" value="<?php echo set_value('email') ?>" name="email" id="email" data-error="#email1" required>
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
                                <input id="agree_box" name="agree_box" type="checkbox" checked>
                                <label for="agree_box" class="agree_label">I agree to the <a class="theme-primary-color" href="<?php echo user_base_url() . 'terms' ?>">Terms</a>, <a class="theme-primary-color" href="<?php echo user_base_url() . 'privacy_policy' ?>">Privacy Policy</a> and <a class="theme-primary-color" href="<?php echo user_base_url() . 'faq' ?>">Fees</a></label>
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input class="sub_btn" type="submit" value="Sign Up">
                        </div>
                    </form>
                    <div class="option">
                        Already have an account? <a class="theme-primary-color" href="<?php echo user_base_url() ?>signin">Login</a>
                    </div>
                    <div class="or"><span>Or</span></div>
                    <ul class="social-icons">
                        <li>
                            <a href="<?php echo user_base_url() ?>account/social_signin?provider=facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo user_base_url() ?>account/social_signin?provider=twitter" class="active">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo user_base_url() ?>account/social_signin?provider=google">
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
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            $.validator.addMethod("strongPass", function(value, element) {
                // allow any non-whitespace characters as the host part
                return this.optional(element) || strongRegex.test(value);
            }, 'Password must contain atleast 1 lower case, 1 upper case, 1 numeric and 1 special character');
            var validator = $('#datas_form').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        strongPass: true
                    },
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                    agree_box: {
                        required: true
                    }
                },
                messages: {
                    password: {
                        required: "Password is required field",
                        minlength: "Password must be atleast 8 characters long",
                        strongPass: "Password must contain atleast 1 lower case, 1 upper case, 1 numeric and 1 special character"
                    },
                    lname: {
                        required: "First Name is required field"
                    },
                    agree_box: {
                        required: "You have to agree with out Terms, Privacy Policy and Fees"
                    },
                    fname: {
                        required: "Last Name is required field"
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