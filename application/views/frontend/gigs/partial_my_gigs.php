<div class="row">
    <?php
    if ($gigs) :
    ?>
        <?php
        foreach ($gigs as $gig) :
        ?>
            <div class="col-md-4">
                <div class="card grid-card" style="background: transparent;">
                    <div class="card-header p-0">
                        <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                            <img src="<?php echo $gig->poster ? poster_thumbnail_url() . $gig->poster : user_asset_url() . 'images/home/slider-02/card-img01.png' ?>" style="width: 358px; height: 352px;" class="w-100">
                        </a>
                    </div>
                    <div class="card-footer grid-footer">
                        <div class="d-flex">
                            <span class="add-gallery">
                                <a href="<?php echo user_base_url() . 'gigs/add_gallery/' . $gig->id ?>"><i class="fas fa-images"></i></a>
                            </span>
                            <div class="footer-text">
                                <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                    <h5><?php echo $gig->title ?></h5>
                                </a>
                                <h6><?php echo $gig->user_name ?></h6>
                                <p><?php echo $gig->gig_date ? date('d M Y', strtotime($gig->gig_date)) : 'Not set' ?></p>
                                <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo $gig->days_left == 'NA' ? 'NA' : (abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today') ?></p>
                            </div>
                            <div class="circlebar">
                                <div class="pie_progress3 booked-color-3" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                    <div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
                                    <div class="pie_progress__label">Booked</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo user_base_url() ?>gigs/update/<?php echo $gig->id ?>" class="btn btn-warning btn-view mb-4">edit</a>
                        <a href="<?php echo user_base_url() . 'transactions/show/' . $gig->id ?>" class="btn btn-warning btn-view mb-4" target="_blank">purchases</a>
                        <form action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                            <button type="submit" class="btn btn-warning btn-watch mb-4">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    <?php
    else :
    ?>
        <div class="col-12">No record found</div>
    <?php
    endif;
    ?>
</div>

<script>

</script>
