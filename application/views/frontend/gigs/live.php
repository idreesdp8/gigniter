<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <script src="https://player.live-video.net/1.2.0/amazon-ivs-player.min.js"></script>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="detail-page-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========photo-Section========== -->
    <section class="section-summery" style="margin: 0 auto;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2 mt-5">
                    <video id="video-player" playsinline controls width="100%" height="100%"></video>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2 mt-5">
                    <a href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig_id ?>" type="button" class="btn btn-primary btn-step-continue nextBtn">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========photo-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        if (IVSPlayer.isPlayerSupported) {
            const player = IVSPlayer.create();
            player.attachHTMLVideoElement(document.getElementById('video-player'));
            player.load('<?php echo $playback_url ?>');
            player.play();
        }
    </script>
</body>

</html>