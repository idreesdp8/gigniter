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
                        <h6>
                            <?php if ($this->session->flashdata('success_msg')) { ?>
                                <?php echo $this->session->flashdata('success_msg'); ?>
                            <?php }
                            if ($this->session->flashdata('error_msg')) { ?>
                                <?php echo $this->session->flashdata('error_msg'); ?>
                            <?php } ?>
                        </h6>
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