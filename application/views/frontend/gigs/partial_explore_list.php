<?php
if ($gigs) :
    foreach ($gigs as $gig) :
?>
        <div class="card explore-card">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <img class="explore-img" src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="width: 343px; height: 577px;">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                    <h5><?php echo $gig->title ?></h5>
                    <h6><?php echo $gig->user_name ?></h6>
                    <p>
                        <?php echo $gig->genre_name ?> <span>|</span> <?php echo $gig->category_name ?>
                    </p>
                    <!-- <p>Music <span>|</span> Show <span>|</span> English</p> -->
                    <p class="explore-margin-bottom">Release Date <span>: </span><?php echo date('d M Y', strtotime($gig->gig_date)) ?></p>

                    <span class="badge badge-danger booked-badge"><?php echo $gig->booked ?>% Booked</span>
                    <p><span class="mr-2 m-b-4"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                    <div class="custom-border">
                        <button class="btn btn-warning btn-booked">Book Now</button>
                        <p class="remaining-days"><span class="mr-2 m-b-4"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today' ?></p>
                    </div>

                </div>
            </div>
        </div>
<?php
    endforeach;
endif;
?>