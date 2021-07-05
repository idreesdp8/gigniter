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
                <div class="account-area" style="max-width: 600px;">
                    <?php $this->load->view('alert/alert'); ?>
                    <div class="section-header-3">
                        <span class="cate">Reset your password</span>
                        <!-- <h2 class="title">to Gigniter </h2> -->
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/reset_password'); ?>" method="post">
                        <input type="hidden" name="email" value="<?php echo $email ?? '' ?>">
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
                        <div class="form-group text-center">
                            <input class="sub_btn" type="submit" value="Reset">
                        </div>
                    </form>
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
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Password is required field"
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