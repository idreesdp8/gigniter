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
                                <span class="badge badge-danger exclusive-badge text-danger border-danger text-left">Rejected</span>
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
                                <p class="mb-3"><span class="mr-2"><img src="<?php echo user_asset_url(); ?>images/icons/calender.png"></span>
                                    <?php
                                    if ($gig->days_left < 0)
                                        echo abs($gig->days_left) . ' days ago';
                                    elseif ($gig->days_left == 'NA')
                                        echo 'NA';
                                    elseif ($gig->days_left > 0)
                                        echo $gig->days_left . ' days left';
                                    else
                                        echo 'Today';
                                    ?>
                                </p>
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
                        if ((!$prev_completed || $prev_completed) && !$gig->is_approved && !$gig->is_rejected && $gig->status == 0 && $gig->is_draft && $gig->is_complete) :
                        ?>
                            <button type="button" class="btn btn-warning btn-view mb-4" onclick="approval_submit(<?php echo $gig->id ?>)">Submit for Approval</button>
                        <?php
                        endif;
                        if (!$gig->is_approved) :
                        ?>
                            <a href="<?php echo user_base_url() ?>gigs/update/<?php echo $gig->id ?>" class="btn btn-warning btn-view mb-4"><?php echo $gig->is_complete ? 'edit' : 'complete gig' ?></a>
                            <?php
                            if ($gig->is_rejected) :
                            ?>
                                <a href="<?php echo user_base_url() ?>gigs/resubmit_for_approval/<?php echo $gig->id ?>" class="btn btn-warning btn-view mb-4">Resubmit for Approval</a>
                            <?php
                            endif;
                            ?>
                            <form class="datas_form mb-3" method="post" action="<?php echo user_base_url() ?>gigs/trash/<?php echo $gig->id ?>">
                                <button type="submit" class="btn btn-warning btn-watch delete_btn" onclick="delete_gig()">Delete</button>
                            </form>
                        <?php
                        endif;
                        if ($gig->is_approved) :
                        ?>
                            <a href="<?php echo user_base_url() . 'transactions/tickets/' . $gig->id ?>" class="btn btn-warning btn-view mb-4" target="_blank">tickets</a>
                            <a href="<?php echo user_base_url() . 'transactions/show/' . $gig->id ?>" class="btn btn-warning btn-view mb-4" target="_blank">purchases</a>
                        <?php
                        endif;
                        ?>
                        <button type="button" data-target="#showModal" class="btn btn-warning btn-view mb-4 showModal" data-value=<?php echo $gig->id ?>>gig history</button>
                        <!-- <button type="button" data-target="#showModal" class="btn btn-info btn-icon showModal" data-value=<?php echo $record->id ?>><span data-popup="tooltip" data-original-title="See gig history"><i class="icon-list"></i></span></button> -->
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


<div id="showModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gig History
                    <small class="d-block text-muted" id="gigName"></small>
                </h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function approval_submit(id) {
        // console.log(id)
        $.ajax({
            url: base_url + 'gigs/submit_for_approval',
            data: {
                id: id
            },
            method: 'POST',
            success: function(resp) {
                if (resp) {
                    swal({
                        icon: 'success',
                        title: 'Your Gig is submitted for approval!',
                    });
                } else {
                    swal({
                        icon: 'warning',
                        title: 'You have already submitted a gig for approval',
                    });
                }
            }
        })
    }

    function delete_gig() {
        event.preventDefault()
        var form = event.target.form
        // console.log(form)
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

    var showModal = document.getElementsByClassName('showModal')
    for (var i = 0; i < showModal.length; i++) {
        showModal[i].addEventListener('click', function(e) {
            openModal(e.currentTarget.dataset.value)
        })
    }

    function openModal(gig_id) {
        console.log(gig_id)
        $.ajax({
            url: base_url + 'gigs/get_gig_history',
            data: {
                gig_id: gig_id
            },
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                var html_text = ''
                $('#gigName').html(response.gig.title)
                if (response.gig_history.length > 0) {
                    response.gig_history.map(function(value, index) {
                        var class_text = '';
                        if (value.action === 'gig_approved') {
                            class_text += 'text-success';
                        } else if (value.action === 'gig_rejected') {
                            class_text += 'text-danger';
                        } else if (value.action === 'gig_submitted') {
                            class_text += 'text-primary';
                        } else if (value.action === 'gig_created') {
                            class_text += 'text-teal';
                        }
                        var dateTime = new Date(value.created_on)
                        let options = {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        };
                        html_text += '<h6 class="font-weight-semibold ' + class_text + '">' + value.text + '<p class="font-weight-normal font-size-sm text-muted">' + dateTime.toLocaleString('en-GB', options) + '</p></h6>'
                    })
                } else {
                    html_text += '<div>No gig history found!</div>'
                }
                $('.modal-body').empty().html(html_text)
                $('#showModal').modal('show');
            }
        })
    }
</script>