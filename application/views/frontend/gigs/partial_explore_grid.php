<?php
if ($gigs) :
?>
    <div class="row">
        <?php
        foreach ($gigs as $gig) :
        ?>
            <div class="col-md-4">
                <div class="card grid-card" style="background: transparent;">
                    <div class="card-header p-0 explore_image_holder" style="width: 100%; height: 352px;">
                        <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                            <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>">
                        </a>
                    </div>
                    <div class="card-footer grid-footer">
                        <h5 class="limit-single-line"><?php echo $gig->title ?></h5>
                        <div class="d-flex">
                            <div class="footer-text">

                                <h6><?php echo $gig->user_name ?></h6>
                                <p><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>
                                <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                            </div>
                            <div class="circlebar">
                                <!-- <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>"> -->
                                <div class="pie_progress <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                    <div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
                                    <div class="pie_progress__label">Booked</div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex" style="align-items: flex-start;">
                            <?php
                            if ($this->session->userdata('us_id') != $gig->user_id) :
                            ?>
                                <a style="margin-right:10px;width:100%;" href="<?php echo user_base_url() . 'cart/book_tier/' . $gig->id; ?>"><button type="button" class="btn btn-warning btn-watch mb-4">book now</button></a>
                            <?php
                            endif;
                            ?>
                            <a href="<?php echo user_base_url() . 'gigs/detail?gig=' . $gig->id ?>" class="btn btn-warning btn-view mb-4">view</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    <div style="float:right;"> <?php echo $this->ajax_pagination->create_links(); ?></div>
<?php
else :
?>
    <div>No record found</div>
<?php
endif;
?>