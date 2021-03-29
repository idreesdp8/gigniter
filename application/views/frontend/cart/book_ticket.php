<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style type="text/css">
        .ticket--item .ticket-content ul .placeholder-img::before {
            background: url(./assets/images/100.png) no-repeat center center;
            background-size: auto;
            background-size: auto;
            height: 40px;
            width: 40px;
            background-size: contain;
        }

        .placeholder-img {
            padding-left: 50px !important;
        }

        .event-cart {
            justify-content: center;
        }

        .event-cart {
            color: #000;
        }

        .cart-plus-minus input {
            color: #000;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="details-banner event-details-banner hero-area bg_img seat-plan-banner" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title"><span class="d-block"><?php echo $gig->title ?></span>
                        <span class="d-block"><?php echo date('M d, Y', strtotime($gig->gig_date)) ?></span>
                    </h3>
                    <div class="tags">
                        <?php
                        if ($venues) :
                            foreach ($venues as $key => $val) :
                        ?>
                                <span><?php echo $val ?></span>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <div class="event-facility padding-bottom padding-top">
        <form method="post" action="<?php echo user_base_url() ?>cart/add">
            <input type="hidden" name="gig_id" value="<?php echo $gig->id ?>" />
            <div class="container">
        <?php $this->load->view('alert/alert'); ?>
                <div class="section-header-3">
                    <span class="cate">simple pricing</span>
                    <h2 class="title">Choose package</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="speaker--slider product-slider text-center" id="carousel_2">
                            <div class="speaker-slider2 owl-carousel owl-theme">
                                <?php
                                if ($tiers) :
                                    $i = 1;
                                    foreach ($tiers as $tier) :
                                ?>
                                        <div class="ticket--item">
                                            <input type="hidden" name="ticket_tier_id[]" value="<?php echo $tier->id ?>" />
                                            <div class="ticket-thumb">
                                                <img src="<?php echo user_asset_url() . 'images/event/ticket/ticket0' . $i . '.png' ?>" alt="event">
                                            </div>
                                            <div class="ticket-content">
                                                <span class="ticket-title"><?php echo $tier->name ?></span>
                                                <h2 class="amount"><sup>$</sup><?php echo $tier->price ?></h2>
                                                <?php
                                                if ($tier->bundles) :
                                                ?>
                                                    <div class="product-img">
                                                        <img src="<?php echo $tier->image != '' ? bundle_url() . $tier->image : user_asset_url() . 'images/cap.png' ?>" alt="Product image">
                                                    </div>
                                                    <div class="product-description">
                                                        <ul>
                                                            <?php
                                                            foreach ($tier->bundles as $bundle) :
                                                            ?>
                                                                <li>*<?php echo $bundle->title ?></li>
                                                            <?php
                                                            endforeach;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                                <div class="cart-button event-cart">
                                                    <div class="cart-plus-minus mb-0">
                                                        <div class="dec qtybutton">-</div>
                                                        <div class="dec qtybutton">-</div>
                                                        <input class="cart-plus-minus-box" type="text" name="qty[]" value="0">
                                                        <div class="inc qtybutton">+</div>
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row justify-content-center mt-4">
                                                    <div class="book-now-button">
                                                        <button type="submit" class="custom-button">book tickets</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                <?php
                                        $i++;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                            <div class="speaker-prev2">
                                <img src="<?php echo user_asset_url() ?>images/icons/arrow-left.png">
                            </div>
                            <div class="speaker-next2">
                                <img src="<?php echo user_asset_url() ?>images/icons/arrow-right.png">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="book-now-button">
                        <button type="submit" class="custom-button">book tickets</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                var pass = false;
                $('.cart-plus-minus-box').each(function(index, elem) {
                    console.log(elem.value);
                    if (elem.value !== 0) {
                        pass = true;
                        return false;
                    } else {
                        pass = false;
                    }
                });
                if (pass) {
                    $.ajax({
                        url: $(this).attr('href'),
                        data: $(this).serialize(),
                        method: 'POST',
                        dataType: 'json',
                        success: function(resp) {
                            if (resp.status == '500') {
                                alert(resp.message);
                            }
                        }
                    })
                    // $('form').submit();
                } else {
                    e.preventDefault();
                    alert('Ticket quantity must be greater than 0');

                }
                // if ($(this).find('.cart-plus-minus-box').val() == 0) {
                //     alert('Ticket quantity must be greater than 0');
                // } else {

                // }
            });
            // $('.custom-button').click(function(){
            //     var input = $('.cart-plus-minus-box');
            // })
            $('.owl-carousel').each(function() {
                if (($(this).find('.owl-item').length) < 4) {
                    $(this).parent().find('.speaker-prev2').addClass('d-none');
                    $(this).parent().find('.speaker-next2').addClass('d-none');
                }
            });
            $('.speaker-prev2, .speaker-next2').on('mouseover', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('stop.owl.autoplay');
            });
            $('.speaker-prev2, .speaker-next2').on('mouseleave', function() {
                console.log($(this).parent().children('.owl-carousel'));
                $(this).parent().children('.owl-carousel').trigger('play.owl.autoplay');
            });
        });
        $('.speaker-slider2').owlCarousel({
            loop: ($(this).find('.owl-item')).length > 3,
            rewind: true,
            responsiveClass: true,
            nav: false,
            dots: false,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 3,
                }
            }
        });
    </script>
</body>

</html>