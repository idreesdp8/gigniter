<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <script src="https://player.live-video.net/1.2.0/amazon-ivs-player.min.js"></script>
    <style>
        .exlpore-title,
        .explore-subtitle {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <?php
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
        ?>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="text-box text-center">
                <h2 class="exlpore-title">AWS TEST</h2>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <div class="container">
            <?php $this->load->view('alert/alert'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-widget checkout-contact">
                        <div class="title">
                            <button type="button" class="btn btn-warning w-25" id="create_channel">Create Channel</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    Stream URL: <span id="stream_url"></span>
                                </div>
                                <div>
                                    Stream Secret Key: <span id="stream_key"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="button" class="btn btn-warning w-25" id="play_video">Play Stream</button>
                            </div>
                            <div class="col-lg-12">
                                <video id="video-player" playsinline controls width="100%" height="100%"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {
            let player = '';
            if (IVSPlayer.isPlayerSupported) {
                player = IVSPlayer.create();
                player.attachHTMLVideoElement(document.getElementById('video-player'));
            }
            $('#create_channel').click(function() {
                $.ajax({
                    url: base_url + 'aws_test/create_channel',
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $('#stream_url').html(data.stream_url)
                        $('#stream_key').html(data.stream_key)
                        player.load(data.playback_url);
                    }

                })
            })
            $('#play_video').click(function() {
                player.play();
            })
        })
    </script>
</body>

</html>