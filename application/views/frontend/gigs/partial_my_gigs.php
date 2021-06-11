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
                            <?php if ($gig->is_approved == 1 && $gig->is_rejected == 0 && $gig->is_draft == 0) : ?>
                                <span class="badge badge-danger exclusive-badge">Approved</span>
                            <?php elseif ($gig->is_draft == 1 && $gig->is_approved == 0 && $gig->is_rejected == 0) : ?>
                                <span class="badge badge-danger exclusive-badge">Draft</span>
                            <?php elseif ($gig->is_approved == 0 && $gig->is_rejected == 0 && $gig->is_draft == 0) : ?>
                                <span class="badge badge-danger exclusive-badge">Waiting for Approval</span>
                            <?php elseif ($gig->is_rejected == 1 && $gig->is_approved == 0 && $gig->is_draft == 0) : ?>
                                <span class="badge badge-danger exclusive-badge">Rejected</span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="card-footer grid-footer">
                        <div class="d-flex">
                            <div class="footer-text">
                                <a href="<?php echo user_base_url(); ?>gigs/detail?gig=<?php echo $gig->id ?>">
                                    <h5><?php echo $gig->title ?></h5>
                                </a>
                                <h6><?php echo $gig->user_name ?></h6>
                                <p><?php echo $gig->gig_date ? date('d M Y', strtotime($gig->gig_date)) : 'Not set' ?></p>
                                <p><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/ticket.png"></span><?php echo $gig->ticket_left ?> tickets left</p>
                                <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span><?php echo $gig->days_left == 'NA' ? 'NA' : (abs($gig->days_left) > 0 ? abs($gig->days_left) . ' days left' : 'Today') ?></p>
                            </div>
                            <div>
                                <div class="add-gallery">
                                    <a data-toggle="tooltip" data-placement="top" title="Add gallery images to your gig" href="<?php echo user_base_url() . 'gigs/add_gallery/' . $gig->id ?>"><i class="fas fa-images"></i></a>
                                </div>
                                <div class="circlebar">
                                    <div class="pie_progress3 <?php echo $gig->booked < 60 ? 'booked-color-2' : 'booked-color-1' ?>" role="progressbar" data-goal="<?php echo $gig->booked ?>">
                                        <div class="pie_progress__number"><?php echo $gig->booked ?>%</div>
                                        <div class="pie_progress__label">Booked</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!$gig->is_approved) :
                        ?>
                            <a href="<?php echo user_base_url() ?>gigs/update/<?php echo $gig->id ?>" class="btn btn-warning btn-view mb-4">edit</a>
                        <?php
                        endif;
                        if ($gig->is_approved) :
                        ?>
                            <a href="<?php echo user_base_url() . 'transactions/show/' . $gig->id ?>" class="btn btn-warning btn-view mb-4" target="_blank">purchases</a>
                        <?php
                        endif;
                        if (!$gig->is_approved) :
                        ?>
                            <form class="datas_form" method="post" action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                                <button type="submit" class="btn btn-warning btn-watch mb-4 delete_btn" onclick="delete_gig()">Delete</button>
                            </form>
                        <?php
                        endif;
                        ?>
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
</script>