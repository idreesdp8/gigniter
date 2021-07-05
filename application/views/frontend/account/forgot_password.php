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
                        <span class="cate">Recover your password</span>
                        <!-- <h2 class="title">to Gigniter </h2> -->
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/forgot_password'); ?>" method="post">
                        <div class="form-group">
                            <label for="email1">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="email" id="email" data-error="#email1" required>
                            <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
                        </div>
                        <div class="form-group text-center">
                            <input class="sub_btn" type="submit" value="Submit">
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
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    email: {
                        required: "Email is required field",
                        email: "Please enter a valid Email address!"
                    },
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