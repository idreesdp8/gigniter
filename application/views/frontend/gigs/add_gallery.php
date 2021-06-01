<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-2.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">ADD GALLERY<span class="explore-animated-title"> IMAGES</span></h2>
                <!-- <h5 class="explore-subtitle">Buy movie tickets in advance, find movie times watch trailer, read movie reviews and much more</h5> -->
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========photo-Section========== -->
    <section class="section-margin-top">
        <div class="container">
            <form role="form" action="<?php echo user_base_url() . 'gigs/add_gallery/' ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $gig->id ?>">
                <div class="card">
                    <div class="card-body">
                        <input type="file" name="images[]" accept="image/*" multiple>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ==========photo-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/gigs/book_now'); ?>

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script src="<?php echo user_asset_url(); ?>js/add-to-cart.js"></script>
</body>

</html>