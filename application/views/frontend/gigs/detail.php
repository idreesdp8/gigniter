<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <script src="https://player.live-video.net/1.4.0/amazon-ivs-player.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emojionearea@3.4.2/dist/emojionearea.min.css">
    <style>
        .detail_image_holder {
            overflow: hidden;
            height: 296px;
            width: auto;
        }

        .detail_image_holder img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .object-cover {
            object-fit: cover;
        }

        .object-center {
            object-position: center;
        }

        .gallery_image {
            width: 100% !important;
            height: 100%;
            border-radius: 0 !important;
            object-fit: cover;
        }

        .social-share li {
            display: inline;
            padding: 5px 10px;
        }

        .tier-cast-thumb {
            width: 200px !important;
        }

        .owl-nav.disabled {
            display: none;
        }

        .breadcrumb a {
            color: #d0dbff;
        }

        .breadcrumb a:hover {
            color: #ffffff;
        }

        .breadcrumb {
            color: #d0dbff;
            display: flex;
            padding: .75rem 1rem;
            margin-bottom: 1rem;
            list-style: none;
            background-color: transparent;
            border-radius: 0;
        }

        .breadcrumb-item.active {
            color: #fff;
        }

        .chat-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .card-body {
            background-color: rgba(0, 0, 0, 0.8);
            height: 300px;
            padding: 1.25rem .75rem;
            overflow-y: auto;
        }

        .emojionearea .emojionearea-editor {
            min-height: 4rem;
        }

        .emojionearea {
            border-radius: 0 !important;
        }

        #chat_form button {
            border-radius: 0 0 0.25rem 0.25rem !important;
        }

        .read_more {
            cursor: pointer;
            color: #eec205;
        }

        .read_more:hover {
            color: #31d7a9;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>
    <!-- Page content -->
    <!-- ==========Banner-Section========== -->
    <section class="detail-page-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
        <div class="container">
            <div class="row custom-row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="detail_image_holder">
                        <!-- style="width: 165px; height: 296px;" -->
                        <img src="<?php echo $gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" alt="image">
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-6">
                    <div class="custom-text">
                        <h5 class="title"><?php echo $gig->title; ?></h5>
                        <h6 class="d-md-flex align-items-md-center">
                            <a target="_blank" href="<?php echo user_base_url() . 'account/profile/' . $gig->user_id ?>"><?php echo $gig->user_name; ?></a>

                        </h6>
                        <p class="mb-0">
                            <?php echo $gig->genre_name ?> <span>|</span> <?php echo $gig->category_name ?>
                        </p>
                        <div class="social-and-duration d-flex align-items-center justify-content-between">
                            <div class="duration-area d-flex">
                                <div class="item mr-3">
                                    <i class="fas fa-calendar-alt mr-2"></i><span><?php echo date('d M, Y', strtotime($gig->gig_date)); ?></span>
                                </div>
                                <div class="item">
                                    <i class="far fa-clock mr-2"></i><span><?php echo $gig->duration ?></span>
                                </div>
                            </div>
                            <ul class="social-icons">
                                <?php
                                if (isset($user->facebook)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->facebook) ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->instagram)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->instagram) ?>">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->twitter)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->twitter) ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->linkedin)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->linkedin) ?>">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->pinterest)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->pinterest) ?>">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                if (isset($user->behance)) :
                                ?>
                                    <li>
                                        <a class="btn-theme-primary artist-links" target="_blank" href="<?php echo prep_url($user->behance) ?>">
                                            <i class="fab fa-behance"></i>
                                        </a>
                                    </li>
                                <?php
                                endif;
                                ?>
                            </ul>
                            <!-- <ul class="social-share detail-page">
                                <?php
                                if (isset($user->facebook)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->facebook) ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <?php
                                endif;
                                if (isset($user->instagram)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->instagram) ?>"><i class="fab fa-instagram"></i></a></li>
                                <?php
                                endif;
                                if (isset($user->twitter)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->twitter) ?>"><i class="fab fa-twitter"></i></a></li>
                                <?php
                                endif;
                                if (isset($user->linkedin)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->linkedin) ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                <?php
                                endif;
                                if (isset($user->pinterest)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->pinterest) ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                <?php
                                endif;
                                if (isset($user->behance)) :
                                ?>
                                    <li><a href="<?php echo prep_url($user->behance) ?>"><i class="fab fa-behance"></i></a></li>
                                <?php
                                endif;
                                ?>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12"></div>
            </div>


        </div>
        <div class="width_fl">
            <div class="container">
                <div class="row custom-bottom">
                    <div class="col-lg-3 col-md-3 col-sm-12"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="custom-item">
                            <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked; ?>">
                                <div class="pie_progress__number"><?php echo $gig->booked; ?>%</div>
                                <div class="pie_progress__label">Booked</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 custom-items">
                        <div class="custom-item2">
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left; ?> tickets left</p>
                            <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo $gig->days_left; ?> days left</p>
                        </div>
                        <?php
                        if ($this->session->userdata('us_id') == $gig->user_id) :
                            if (!$gig->is_approved) :
                        ?>
                                <div class="custom-item3 d-flex skicky-buttons ">
                                    <form action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                                        <button type="submit" class="btn btn-warning btn-booking" onclick="delete_gig()">Delete</button>
                                    </form>
                                    <a type="button" class="btn btn-warning btn-booking ml-2 d-flex align-items-center" href="<?php echo user_base_url() . 'gigs/update/' . $gig->id ?>">edit gig</a>
                                </div>
                            <?php
                            else :
                            ?>
                                <div class="custom-item3">
                                    <?php
                                    if ($stream_details) :
                                    ?>
                                        <a type="button" class="skicky-buttons btn btn-warning btn-booking" href="<?php echo user_base_url() . 'gigs/test_stream/' . $gig->id ?>">Test Stream</a>
                                    <?php
                                    endif;
                                    ?>
                                    <a type="button" class="skicky-buttons btn btn-warning btn-booking" href="<?php echo user_base_url() . 'transactions/show/' . $gig->id ?>">view purchases</a>
                                </div>
                            <?php
                            endif;
                        endif;
                        if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                            if ($gig->status == 1) :
                            ?>
                                <div class="custom-item3">
                                    <a type="button" class="skicky-buttons btn btn-warning btn-booking" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>">
                                        <?php
                                        echo !empty($user_bookings) ? 'book more' : 'book now';
                                        ?>
                                    </a>
                                </div>
                                <?php
                            elseif ($gig->status == 2) :
                                if (empty($user_bookings)) :
                                ?>
                                    <div class="custom-item3">
                                        <a type="button" class="skicky-buttons btn btn-warning btn-booking" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>">book now</a>
                                    </div>
                        <?php
                                endif;
                            endif;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========photo-Section========== -->
    <section style="background-color: #0a1e5e;padding-top: 5px;" class="section-margin-top">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo user_base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $gig->title ?></li>
                </ol>
            </nav>
            <?php
            if ($gig->user_id == $this->session->userdata('us_id')) :
            ?>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <div class="photo-heading">
                            <h3>
                                Stream Details
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="photo-heading">
                            <button class="btn btn-theme-primary" data-toggle="modal" data-target="#exampleModal">Important Information</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <p class="sub-title"><strong>Stream URL: </strong><?php echo $stream_details ? '<span id="stream_url">' . $stream_details->stream_url . '</span>' : 'NA' ?></p>
                    <span><i class="fa fa-copy ml-2 cursor-pointer" onclick="copy(this)"></i></span>
                </div>
                <div class="d-flex">
                    <p class="sub-title"><strong>Stream Secret Key: </strong><?php echo $stream_details ? '<span id="stream_key">' . $stream_details->stream_key . '</span>' : 'NA' ?></p>
                    <span><i class="fa fa-copy ml-2 cursor-pointer" onclick="copy(this)"></i></span>
                </div>
            <?php
            endif;
            ?>
            <!-- <div class="row mt-5 mb-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                </div>
            </div> -->
            <?php
            if ($gig->images) :
            ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="photo-heading">
                            <h3>Photos</h3>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <?php
                    if ($gig->images) :
                    ?>
                        <!-- <div class="row photos"> -->
                        <div class="casting-slider-two owl-carousel detailpage-crousal">
                            <?php
                            foreach ($gig->images as $gig_gallery) :
                            ?>
                                <div class="cast-item">
                                    <a href="<?php echo gig_images_url() . $gig_gallery->image ?>" class="img-pop">
                                        <div class="cast-thumb" style="border-radius: 0;">
                                            <img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="gallery_image" alt="image">
                                        </div>
                                    </a>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12"><img src="<?php echo gig_images_url() . $gig_gallery->image ?>" class="w-100"></div> -->
                            <?php
                            endforeach;
                            ?>
                        </div>
                    <?php
                    endif;
                    $this->dbs_user_id = $this->session->userdata('us_id');
                    ?>

                    <div class="post-item post-details mb-1">
                        <div class="post-thumb">
                            <div id="wrapper-video">
                                <?php
                                if ($gig->status == 2 && (!$this->dbs_user_id || $this->dbs_user_id && !in_array($this->dbs_user_id, $gig->buyers) && !($gig->user_id == $this->dbs_user_id))) :
                                ?>
                                    <div class="overlay-video"></div>
                                    <?php
                                endif;
                                if ($gig->status == 2 && in_array($this->dbs_user_id, $gig->buyers)) {
                                    header('Access-Control-Allow-Origin: *');
                                    header("Access-Control-Allow-Methods: GET, OPTIONS");
                                    echo '<video id="video-player" playsinline controls width="100%" height="100%"></video>';
                                } else {
                                    if (isset($gig->video) && $gig->video != '') : ?>
                                        <video playsinline="playsinline" autoplay="autoplay" controls loop="loop">
                                            <source src="<?php echo $gig->video ? video_url() . $gig->video : 'https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4' ?>" type="video/mp4">
                                        </video>
                                    <?php else : ?>
                                        <img src="<?php echo $gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/blog/blog01.jpg' ?>" alt="blog" class="object-cover object-center">
                                    <?php
                                    endif;
                                }
                                if ($gig->status == 2 && (!$this->dbs_user_id || $this->dbs_user_id && !in_array($this->dbs_user_id, $gig->buyers) && !($gig->user_id == $this->dbs_user_id))) : ?>

                                    <div class=" container h-100 particlesContainer">
                                        <div class="d-flex h-100 text-center align-items-center">
                                            <div class="w-100 text-white">
                                                <h1 class="display-3">The Gig is ON!</h1>
                                                <p class="lead mb-0">Join Here</p>
                                                <a href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>" style="width:250px; border: 1px solid #f1c600;" type="button" class="btn-theme-primary btn btn-primary mx-auto mt-4">Book your spot</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>
                                <div class="reactions-onfeed"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $url = rawurlencode(user_base_url() . 'gigs/detail?gig=' . $gig->id);
                    $imgurl = rawurlencode($gig->poster ? poster_url() . $gig->poster : user_asset_url() . 'images/blog/blog01.jpg');
                    ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-3 text-lg-left text-center">
                            <ul class="social-share">
                                <li class="padding-5-10"><a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo $url ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="padding-5-10"><a onclick="window.open('https://twitter.com/share?url=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://twitter.com/share?url=<?php echo $url ?>"><i class="fab fa-twitter"></i></a></li>
                                <li class="padding-5-10"><a onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php echo $url ?>&media=<?php echo $imgurl; ?>&description=<?php echo $gig->title ?>','sharer','width=500,height=700'); return false;" href="https://pinterest.com/pin/create/button/?url=<?php echo $url ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                <li class="padding-5-10"><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>','sharer','width=500,height=700'); return false;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url ?>"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>

                        <?php if ($gig->status == 2 && $this->dbs_user_id) : ?>
                            <div class="col-lg-6 col-md-6 col-12 text-lg-right text-center">
                                <div class="reactions-live d-inline-flex">
                                    <p data-emoji="thumbs-up" data-gig_id="<?php echo $gig->id ?>" class="noselect like-emoji emoji-starter selector-reactions mr-2 reactions-btn mb-0">
                                        <i class="like-blue fas fa-thumbs-up mr-2"></i><span>Like</span>&nbsp(<span id="like-count"><?php echo $gig->reactions->like_reactions ?? '0' ?></span>)
                                    </p>
                                    <p data-emoji="heart" data-gig_id="<?php echo $gig->id ?>" class="noselect emoji-starter heart mr-2 reactions-btn mb-0">
                                        <i class="heart-red fas fa-heart mr-2"></i><span>Heart</span>&nbsp(<span id="heart-count"><?php echo $gig->reactions->heart_reactions ?? '0' ?></span>)
                                    </p>

                                </div>
                            </div>
                        <?php endif; ?>


                    </div>


                    <?php
                    if ($tiers) :
                    ?>
                        <div class="movie-details">
                            <div class="tab summery-review">
                                <div class="tab-area">
                                    <div class="tab-item active">
                                        <div class="item">
                                            <div class="header">
                                                <h5 class="sub-title">ticket tiers</h5>
                                                <div class="navigation <?php echo count($tiers) < 3 ? 'd-none' : '' ?>">
                                                    <div class="cast-prev"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                    <div class="cast-next"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                </div>
                                            </div>
                                            <div class="casting-slider owl-carousel">
                                                <?php
                                                foreach ($tiers as $tier) :
                                                ?>
                                                    <div class="cast-item mb-2">
                                                        <div class="cast-thumb tier-cast-thumb">
                                                            <a href="#0">
                                                                <img src="<?php echo $tier->image != '' ? bundle_url() . $tier->image : user_asset_url() . 'images/default.png' ?>" alt="cast">
                                                            </a>
                                                        </div>
                                                        <div class="cast-content">
                                                            <h6 class="cast-title"><a href="#0"><?php echo $tier->name ?></a></h6>
                                                            <span class="cate">$<?php echo $tier->price ?>/<?php echo $tier->quantity;
                                                                                                            echo $tier->quantity > 1 ? ' Tickets' : ' Ticket' ?></span>
                                                            <?php if ($tier->description) : ?>
                                                                <span class="cate"><?php echo str_word_count($tier->description) > 5 ? implode(' ', array_slice(explode(' ', $tier->description), 0, 6)) . ' ... <span class="read_more" data-desc="' . $tier->description . '">Read More</span>' : $tier->description ?></span>
                                                            <?php endif; ?>
                                                            <?php
                                                            if ($this->session->userdata('us_id') != $gig->user_id && ($gig->ticket_left != 0 || $gig->is_overshoot)) :
                                                            ?>
                                                                <a type="button" class="btn-theme-primary btn" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id ?>">book now</a>
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <img src="<?php echo user_asset_url(); ?>images/detail-page/custom-text-box.png" class="w-100">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="card" style="background-color: #5560ff;border: 0px;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5 style="text-align: center">Chat Room</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="messages_area">
                            <!-- <div class="d-flex align-items-center justify-content-between mb-2">
                                <img src="<?php echo downloads_url() ?>gig8.jpg" alt="user_image" class="chat-img">
                                <span>2:58 PM</span>
                                <span>Nelson Mandella</span>
                                <span>Hi</span>
                            </div> -->
                            <?php
                            //     foreach ($chat_data as $chat) {
                            //         if (isset($_SESSION['user_data'][$chat['userid']])) {
                            //             $from = 'Me';
                            //             $row_class = 'row justify-content-start';
                            //             $background_class = 'text-dark alert-light';
                            //         } else {
                            //             $from = $chat['user_name'];
                            //             $row_class = 'row justify-content-end';
                            //             $background_class = 'alert-success';
                            //         }

                            //         echo '
                            // <div class="' . $row_class . '">
                            // 	<div class="col-sm-10">
                            // 		<div class="shadow-sm alert ' . $background_class . '">
                            // 			<b>' . $from . ' - </b>' . $chat["msg"] . '
                            // 			<br />
                            // 			<div class="text-right">
                            // 				<small><i>' . $chat["created_on"] . '</i></small>
                            // 			</div>
                            // 		</div>
                            // 	</div>
                            // </div>
                            // ';
                            //     }
                            ?>
                        </div>
                    </div>
                    <form method="post" id="chat_form">
                        <div class="mb-3">
                            <textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" required></textarea>
                            <div class="">
                                <button type="submit" name="send" id="send" class="btn btn-theme-primary">Send <i class="fa fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========photo-Section========== -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Streaming Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Here is some important information regarding your streaming.</p>
                    <ol>
                        <li>
                            <p>Download OBS Studio from here: <a target="_blank" href="https://obsproject.com/download">Download OBS</a></p>
                        </li>
                    </ol>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal2Label">Ticket Tier description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('frontend/gigs/book_now'); ?>

    <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script src="<?php echo user_asset_url(); ?>js/add-to-cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/emojionearea@3.4.2/dist/emojionearea.min.js"></script>
    <script>
        function delete_gig() {
            event.preventDefault()
            var form = event.target.form
            console.log(form)
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal({
                        icon: 'info',
                        title: 'Your Gig is safe!',
                    });
                }
            });
        }
        $(document).ready(function() {

            $('.read_more').click(function() {
                var desc = this.dataset.desc
                $('#exampleModal2 .modal-body').html(desc)
                $('#exampleModal2').modal('show');
            })

            $('#chat_form').on('submit', function(event) {
                event.preventDefault();
                var user_id = <?php echo $this->session->userdata('us_id') ?? 0 ?>;
                var message = $('#chat_message').val();
                var gig_id = <?php echo $gig->id ?>;
                var data = {
                    userId: user_id,
                    msg: message,
                    gigId: gig_id,
                };
                $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);
            });
            $('#send').click(function(e) {
                e.preventDefault();
                var message = $('#chat_message').val();

            })

            $("#chat_message").emojioneArea({
                picketPosition: "top",
                toneStyle: "bullet"
            });

            $(window).scroll(function() {
                var sticky = $('.skicky-buttons'),
                    scroll = $(window).scrollTop();

                if (scroll >= 500) sticky.addClass('fixed-button-top');
                else sticky.removeClass('fixed-button-top');
            });


            // ---------- PARAMETERS ---------

            var randomSpeeds = function() {
                return getRandomInteger(1000, 3000)
            } // The lower, the faster
            var delay = 50 // The higher, the more delay
            var startScreenPercentage = 0.70 // starts from 70% of the screen...
            var endScreenPercentage = 0.97 // ...till 100% (end) of the screen
            // -------------------------------
            // Generates a random integer between the min and max
            var getRandomInteger = function(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min
            }

            // var fbReactions = ['angry', 'sad', 'surprise', 'happy', 'shy']
            var interval

            $('.heart').on('click', function(event) {
                $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="heart-red fas fa-heart mr-2"></i></p>')
            })
            $('.like-emoji').on('click', function(event) {
                $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="like-blue fas fa-thumbs-up mr-2"></i></p>')
            })
            $('.emoji-starter').on('click', function(event) {
                interval = setInterval(function() {
                    // var emojiName = $(event.target).parent().data("emoji")
                    //  $('.reactions-onfeed').append('<p class="particle jquery-reactions onfeed-like"><i class="like-blue fas fa-'+ emojiName +' mr-2"></i></p>')
                    $('.particle').toArray().forEach(function(particle) {
                        var bounds = getRandomInteger($('.reactions-onfeed').width() * startScreenPercentage, $('.reactions-onfeed').width() * endScreenPercentage)
                        $(particle).animate({
                            left: bounds,
                            right: bounds
                        }, delay, function() {
                            $(particle).animate({
                                top: '-100%',
                                opacity: 0
                            }, randomSpeeds(), function() {
                                $(particle).remove()
                            })
                        })
                    }) /* forEach particle Loop close*/
                    clearInterval(interval)
                }, 1) /* setInterval close*/
            })
            $('.emoji-starter').on('click', function() {
                var reaction = $(this).data("emoji")
                var user_id = '<?php echo $this->session->userdata('us_id') ?>'
                var gig_id = $(this).data("gig_id")
                $.ajax({
                    url: base_url + 'gigs/update_reaction',
                    method: 'post',
                    data: {
                        reaction: reaction,
                        user_id: user_id,
                        gig_id: gig_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        if (result.status) {
                            console.log('reaction done')
                        }
                        $('#like-count').html(result.gig.like_reactions)
                        $('#heart-count').html(result.gig.heart_reactions)
                    }
                })
            })

            function get_reactions() {
                var gig_id = '<?php echo $gig->id ?>'
                console.log(gig_id)
                $.ajax({
                    url: base_url + 'gigs/get_reactions',
                    method: 'post',
                    data: {
                        gig_id: gig_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#like-count').html(result.gig.like_reactions)
                        $('#heart-count').html(result.gig.heart_reactions)
                    }
                })
            }

            setInterval(function() {
                var flag = '<?php echo ($gig->status == 2 && $this->dbs_user_id) ? true : false ?>'
                // console.log(flag)
                if (flag) {
                    get_reactions();
                }
            }, 5000);

            var playback_url = $('#playback_url').val();
            if (IVSPlayer.isPlayerSupported) {
                let player = IVSPlayer.create();
                if (document.getElementById('video-player')) {
                    player.attachHTMLVideoElement(document.getElementById('video-player'));
                }
                player.load('<?php echo $stream_details ? $stream_details->playback_url : "" ?>');
                player.play();
            }
            // })



            $('.cast-prev, .cast-next').on('mouseover', function() {
                console.log($(this).parents('.item').children('.owl-carousel'));
                $(this).parents('.item').children('.owl-carousel').trigger('stop.owl.autoplay');
            });
            $('.cast-prev, .cast-next').on('mouseleave', function() {
                console.log($(this).parents('.item').children('.owl-carousel'));
                $(this).parents('.item').children('.owl-carousel').trigger('play.owl.autoplay');
            });
        })
        $('.detailpage-crousal').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            margin: 30,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                600: {
                    items: 3,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: ($(this).find('.owl-item')).length > 2
                }
            }
        });
        $('.owl-carousel').owlCarousel({
            rewind: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 2000,
            margin: 30,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                600: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 2
                },
                1000: {
                    items: 3,
                    loop: ($(this).find('.owl-item')).length > 2
                }
            }
        });

        function copy(elem) {
            var span = $(elem).parents('.d-flex').find('p > span');
            console.log(span.html());
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(span.html()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
</body>

</html>