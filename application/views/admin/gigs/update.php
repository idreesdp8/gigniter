<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Update Gig</title>
    <style>
        .file-preview-frame {
            margin: auto !important;
        }

        .file-thumbnail-footer {
            display: none;
        }

        .form-check {
            margin-top: .5rem;
        }
    </style>
</head>

<body>
    <?php $this->load->view('admin/layout/header'); ?>
    <div class="page-content">
        <?php $this->load->view('admin/layout/sidebar'); ?>
        <div class="content-wrapper">
            <div class="page-header page-header-light">
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <a href="<?php echo admin_base_url(); ?>gigs" class="breadcrumb-item"> Gigs</a>
                            <span class="breadcrumb-item active">Update Gig</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                    <div class="text-right">
                        <a href="<?php echo $this->agent->referrer(); ?>" type="button" class="btn bg-slate btn-xs">Cancel</a>
                        <button type="submit" class="btn btn-success btn-xs" id="update_gig">Update Gig</button>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view('alert/alert'); ?>
                <!-- Basic layout-->
                <form action="<?php echo admin_base_url() ?>gigs/update" method="post" id="basic_info_form" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">Update Gig</h6>
                            <div class="header-elements">
                                <!-- <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div> -->
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                <li class="nav-item"><a href="#justified-right-icon-tab1" class="nav-link active" data-toggle="tab">Basic Info <i class="icon-mic2 ml-2"></i></a></li>
                                <li class="nav-item"><a href="#justified-right-icon-tab2" class="nav-link" data-toggle="tab">Ticket Tiers <i class="icon-ticket ml-2"></i></a></li>
                                <li class="nav-item"><a href="#justified-right-icon-tab3" class="nav-link" data-toggle="tab">About Artist <i class="icon-user ml-2"></i></a></li>
                                <!-- <li class="nav-item"><a href="#justified-right-icon-tab4" class="nav-link" data-toggle="tab">Inactive <i class="icon-mention ml-2"></i></a></li> -->
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="justified-right-icon-tab1">
                                    <div class="row">
                                        <input type="hidden" id="gig_id" name="id" value="<?php echo $gig->id ?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="<?php echo $gig->title ?>" data-error="#title1">
                                                <span id="title1" class="text-danger" generated="true"><?php echo form_error('title'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Subtitle</label>
                                                <textarea name="subtitle" id="subtitle" cols="30" rows="3" class="form-control" placeholder="Enter subtitle"><?php echo $gig->subtitle ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Audience Goal <span class="text-danger">*</span></label>
                                                        <input type="number" name="ticket_limit" id="ticket_limit" class="form-control" value="<?php echo $gig->ticket_limit ?>" min="0" data-error="#ticket_limit1">
                                                        <span id="ticket_limit1" class="text-danger" generated="true"><?php echo form_error('ticket_limit'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ticket Threshold <span class="text-danger">*</span></label>
                                                        <input type="number" name="threshold" id="threshold" class="form-control" min="0" value="<?php echo $gig->threshold ?>" min="0" data-error="#threshold1">
                                                        <span id="threshold1" class="text-danger" generated="true"><?php echo form_error('threshold'); ?></span>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Target Goal Amount <span class="text-danger">*</span></label>
                                                        <input type="number" name="goal_amount" id="goal_amount" class="form-control" min="0" value="<?php echo $gig->goal_amount ?>" data-error="#goal_amount1">
                                                        <span id="goal_amount1" class="text-danger" generated="true"><?php echo form_error('goal_amount'); ?></span>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Draft</label>
                                                        <select name="is_draft" id="is_draft" class="form-control select">
                                                            <option value="0" <?php echo $gig->is_draft == 0 ? 'selected' : '' ?>>No</option>
                                                            <option value="1" <?php echo $gig->is_draft == 1 ? 'selected' : '' ?>>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Enter address"><?php echo $gig->address ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                                <select name="category" id="category" class="form-control select" data-error="#category1">
                                                                    <option value="">Select Category</option>
                                                                    <?php
                                                                    if (isset($categories)) :
                                                                        foreach ($categories as $category) :
                                                                    ?>
                                                                            <option value="<?php echo $category->value ?>" <?php echo $gig->category == $category->value ? 'selected' : '' ?>><?php echo $category->label ?></option>
                                                                    <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                                <span id="category1" class="text-danger" generated="true"><?php echo form_error('category'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Genre <span class="text-danger">*</span></label>
                                                                <select name="genre" id="genre" class="form-control select" data-error="#genre1">
                                                                    <option value="">Select Genre</option>
                                                                    <?php
                                                                    if (isset($genres)) :
                                                                        foreach ($genres as $genre) :
                                                                    ?>
                                                                            <option value="<?php echo $genre->value ?>" <?php echo $gig->genre == $genre->value ? 'selected' : '' ?>><?php echo $genre->label ?></option>
                                                                    <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                                <span id="genre1" class="text-danger" generated="true"><?php echo form_error('genre'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Overshoot</label>
                                                        <div class="form-check form-check-switchery">
                                                            <label class="form-check-label">
                                                                <!-- Unchecked switch -->
                                                                <input type="checkbox" class="form-check-input-switchery-primary" name="is_overshoot" value="1" data-fouc <?php echo $gig->is_overshoot ? 'checked' : '' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php //$curr_date = date('Y-m-d'); 
                                                        ?>
                                                        <!-- min="<?php //echo $curr_date 
                                                                    ?>" -->
                                                        <label>Campaign Launch Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="campaign_date" id="campaign_date" class="form-control" value="<?php echo $gig->campaign_date ? date('Y-m-d', strtotime($gig->campaign_date)) : null ?>">
                                                        <span id="campaign_date1" class="text-danger" generated="true"><?php echo form_error('campaign_date'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gig Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="gig_date" id="gig_date" class="form-control" value="<?php echo $gig->gig_date ? date('Y-m-d', strtotime($gig->gig_date)) : null ?>">
                                                        <span id="gig_date1" class="text-danger" generated="true"><?php echo form_error('gig_date'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Start Time <span class="text-danger">*</span></label>
                                                        <input type="time" name="start_time" id="start_time" class="form-control" value="<?php echo $gig->gig_date ? date('H:i:s', strtotime($gig->start_time)) : null ?>">
                                                        <span id="start_time1" class="text-danger" generated="true"><?php echo form_error('start_time'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>End Time <span class="text-danger">*</span></label>
                                                        <input type="time" name="end_time" id="end_time" class="form-control" value="<?php echo $gig->gig_date ? date('H:i:s', strtotime($gig->end_time)) : null ?>">
                                                        <span id="end_time1" class="text-danger" generated="true"><?php echo form_error('end_time'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Venue</label>
                                                <br>
                                                <div class="form-check form-check-switchery form-check-inline">
                                                    <label class="form-check-label">
                                                        Live stream
                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="venues[]" value="Live stream" data-fouc <?php echo in_array('Live stream', $gig->venues) ? 'checked' : '' ?>>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-switchery form-check-inline">
                                                    <label class="form-check-label">
                                                        Physical
                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="venues[]" value="Physical" data-fouc <?php echo in_array('Physical', $gig->venues) ? 'checked' : '' ?>>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select">
                                                    <?php
                                                    if (isset($status)) :
                                                        foreach ($status as $k => $v) :
                                                    ?>
                                                            <option value="<?php echo $v->value ?>" <?php echo $gig->status == $v->value ? 'selected' : '' ?>><?php echo $v->label ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Featured Gig</label>
                                                <select name="is_featured" class="form-control select">
                                                    <?php
                                                    // if (isset($status)) :
                                                    //     foreach ($status as $k => $v) :
                                                    ?>
                                                    <option value="0" <?php echo $gig->is_featured ? 'selected' : '' ?>>No</option>
                                                    <option value="1" <?php echo $gig->is_featured ? 'selected' : '' ?>>Yes</option>
                                                    <?php
                                                    //     endforeach;
                                                    // endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Exclusive Gig</label>
                                                <select name="is_exclusive" class="form-control select">
                                                    <?php
                                                    // if (isset($status)) :
                                                    //     foreach ($status as $k => $v) :
                                                    ?>
                                                    <option value="0" <?php echo $gig->is_exclusive ? 'selected' : '' ?>>No</option>
                                                    <option value="1" <?php echo $gig->is_exclusive ? 'selected' : '' ?>>Yes</option>
                                                    <?php
                                                    //     endforeach;
                                                    // endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Poster</label>
                                                <input type="hidden" name="old_poster" class="old_image" value="<?php echo poster_url() . $gig->poster ?>">
                                                <input type="file" name="poster" class="file-input-preview" accept="image/*" data-browse-class="btn btn-primary" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc data-error="#poster1">
                                                <!-- <input type="file" name="image"> -->
                                                <span id="poster1" class="text-danger" generated="true">
                                                    <?php
                                                    echo form_error('image');
                                                    if (isset($_SESSION['prof_img_error'])) {
                                                        echo $_SESSION['prof_img_error'];
                                                    } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="justified-right-icon-tab2">
                                    <div id="ticker_tiers">
                                        <?php
                                        if (isset($tickets) && !empty($tickets)) :
                                            $tier = 1;
                                            foreach ($tickets as $ticket) :
                                        ?>
                                                <div class="card" id="card<?php echo $tier ?>">
                                                    <div class="card-header header-elements-inline">
                                                        <h5 class="card-title">Ticket Tier <?php echo $tier ?></h5>
                                                        <div class="header-elements">
                                                            <div class="list-icons">
                                                                <a class="list-icons-item" data-action="collapse"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" placeholder="Enter ticket tier name" name="ticket_name[]" value="<?php echo $ticket->name ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Price</label>
                                                                    <input type="number" class="form-control" placeholder="Enter ticket price" name="ticket_price[]" min="0" value="<?php echo $ticket->price ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>No. of Ticket</label>
                                                                    <input type="number" class="form-control" placeholder="Enter ticket tier name" name="ticket_quantity[]" min="0" value="<?php echo $ticket->quantity ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Unlimited</label>
                                                                    <div class="form-check form-check-switchery">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_unlimited_<?php echo $tier ?>" value="1" data-fouc <?php echo $ticket->is_unlimited ? 'checked' : '' ?>>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="ticket_description[]" cols="30" rows="2" class="form-control" placeholder="Enter ticket description"><?php echo $ticket->description ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tier_bundles">
                                                            <?php
                                                            $i = 1;
                                                            if (isset($ticket->bundles) && !empty($ticket->bundles)) :
                                                            ?>
                                                                <label class="">Ticket Bundles</label>
                                                                <div class="row mb-2">
                                                                    <?php
                                                                    foreach ($ticket->bundles as $bundle) :
                                                                    ?>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="cursor-pointer text-right mb-2 text-danger remove_tier_bundle"><i class="icon-cross"></i></div>
                                                                                <input type="text" name="bundle_title_tier<?php echo $tier ?>[]" class="form-control" placeholder="Bundle Title" value="<?php echo $bundle->title ?>">
                                                                            </div>
                                                                            <input type="hidden" class="old_image" value="<?php echo bundle_url() . $bundle->image ?>">
                                                                            <input type="hidden" name="old_bundle_image_tier<?php echo $tier ?>[]" value="<?php echo $bundle->image ?>">
                                                                            <input type="file" name="bundle_image_tier<?php echo $tier ?>[]" class="file-input-preview" accept=".jpg,.png,.jpeg,.gif" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                                                                        </div>
                                                                    <?php
                                                                        $i++;
                                                                    endforeach;
                                                                    ?>
                                                                </div>
                                                            <?php
                                                            else :
                                                            ?>
                                                                <label class="d-none">Ticket Bundles</label>
                                                                <div class="row mb-2">

                                                                </div>
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                        <div class="text-right mt-3">
                                                            <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="<?php echo $i ?>" data-tier="<?php echo $tier ?>"><i class="icon-plus3"></i> Add Bundle</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                $tier++;
                                            endforeach;
                                        else :
                                            ?>
                                            <div class="card" id="card1">
                                                <div class="card-header header-elements-inline">
                                                    <h5 class="card-title">Ticket Tier 1</h5>
                                                    <div class="header-elements">
                                                        <div class="list-icons">
                                                            <a class="list-icons-item" data-action="collapse"></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" placeholder="Enter ticket tier name" name="ticket_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket price" name="ticket_price[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>No. of Ticket</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket tier name" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Unlimited</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_unlimited_1" value="1" data-fouc>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="ticket_description[]" cols="30" rows="2" class="form-control" placeholder="Enter ticket description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tier_bundles">
                                                        <label class="d-none">Ticket Bundles</label>
                                                        <div class="row mb-2">

                                                        </div>
                                                    </div>
                                                    <div class="text-right mt-3">
                                                        <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="1"><i class="icon-plus3"></i> Add Bundle</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card" id="card2">
                                                <div class="card-header header-elements-inline">
                                                    <h5 class="card-title">Ticket Tier 2</h5>
                                                    <div class="header-elements">
                                                        <div class="list-icons">
                                                            <a class="list-icons-item" data-action="collapse"></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" placeholder="Enter ticket tier name" name="ticket_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket price" name="ticket_price[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>No. of Ticket</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket tier name" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Unlimited</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_unlimited_2" value="1" data-fouc>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="ticket_description[]" cols="30" rows="2" class="form-control" placeholder="Enter ticket description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tier_bundles">
                                                        <label class="d-none">Ticket Bundles</label>
                                                        <div class="row mb-2">

                                                        </div>
                                                    </div>
                                                    <div class="text-right mt-3">
                                                        <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="2"><i class="icon-plus3"></i> Add Bundle</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card" id="card3">
                                                <div class="card-header header-elements-inline">
                                                    <h5 class="card-title">Ticket Tier 3</h5>
                                                    <div class="header-elements">
                                                        <div class="list-icons">
                                                            <a class="list-icons-item" data-action="collapse"></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" placeholder="Enter ticket tier name" name="ticket_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket price" name="ticket_price[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>No. of Ticket</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket tier name" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Unlimited</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_unlimited_3" value="1" data-fouc>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="ticket_description[]" cols="30" rows="2" class="form-control" placeholder="Enter ticket description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tier_bundles">
                                                        <label class="d-none">Ticket Bundles</label>
                                                        <div class="row mb-2">

                                                        </div>
                                                    </div>
                                                    <div class="text-right mt-3">
                                                        <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="3"><i class="icon-plus3"></i> Add Bundle</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="justified-right-icon-tab3">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $user->fname ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $user->lname ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea name="description" cols="30" rows="3" class="form-control" placeholder="Bio"><?php echo $user->description ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="user_address" cols="30" rows="3" class="form-control" placeholder="Address"><?php echo $user->address ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country_id" id="country_id" class="form-control select">
                                                    <option value="">Select Country</option>
                                                    <?php
                                                    if (isset($countries)) :
                                                        foreach ($countries as $country) :
                                                    ?>
                                                            <option value="<?php echo $country->id ?>" <?php echo $user->country_id == $country->id ? 'selected' : '' ?>><?php echo $country->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="image">Image</label>
                                            <input type="hidden" name="old_image" class="old_image" value="<?php echo $user->image ? profile_image_url() . $user->image : '' ?>">
                                            <input type="file" name="image" class="file-input-preview" accept="image/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc data-error="#image1">
                                            <!-- <input type="file" name="image"> -->
                                            <span id="image1" class="text-danger" generated="true">
                                                <?php
                                                echo form_error('image');
                                                if (isset($_SESSION['prof_img_error'])) {
                                                    echo $_SESSION['prof_img_error'];
                                                } ?>
                                            </span>
                                        </div>
                                    </div>
                                    <label>Social Links</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-envelop"></i></span>
                                                    </span>
                                                    <input name="mail" type="text" class="form-control" placeholder="mail url" value=<?php echo $link[0]['mail'] ?? null ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-facebook2"></i></span>
                                                    </span>
                                                    <input name="facebook" type="text" class="form-control" placeholder="facebook url" value=<?php echo $link[1]['facebook'] ?? null ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-instagram"></i></span>
                                                    </span>
                                                    <input name="instagram" type="text" class="form-control" placeholder="instagram url" value=<?php echo $link[2]['instagram'] ?? null ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-twitter"></i></span>
                                                    </span>
                                                    <input name="twitter" type="text" class="form-control" placeholder="twitter url" value=<?php echo $link[3]['twitter'] ?? null ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-right">
                        <a href="<?php echo $this->agent->referrer(); ?>" type="button" class="btn bg-slate">Cancel</a>
                        <!-- <button type="submit" class="btn btn-success">Update Gig</button> -->
                    </div>
                </form>
                <!-- /basic layout -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhAY-vqTHNYDuLOP-dRo1Bp87rV4A8_-4&libraries=places&callback=initMap">
    </script>
    <script>
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_gig_view a').addClass('active');

            var fileActionSettings = {
                zoomClass: '',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                dragClass: 'p-2',
                dragIcon: '<i class="icon-three-bars"></i>',
                removeClass: '',
                removeErrorClass: 'text-danger',
                removeIcon: '<i class="icon-bin"></i>',
                indicatorNew: '<i class="icon-file-plus text-success"></i>',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
            };

            $('#campaign_date').change(function() {
                var campaign_date = new Date($(this).val());
                var gig_min_date = campaign_date.toISOString().substring(0, 10);
                var gig_max_date = new Date(campaign_date.setDate(campaign_date.getDate() + 30));
                gig_max_date = gig_max_date.toISOString().substring(0, 10);
                $('#gig_date').attr('min', gig_min_date);
                $('#gig_date').attr('max', gig_max_date);
            });

            $('.add_tier_bundle').click(function() {
                var i = $(this).attr('data-bundle');
                var tier = $(this).data('tier');
                var card = '#card' + tier;
                var label = $(this).parents(card).find('.tier_bundles label');
                label.removeClass('d-none');
                var div = $(this).parents(card).find('.tier_bundles .row');
                div.append('<div class="col-md-4">' +
                    '<div class="form-group">' +
                    '<div class="cursor-pointer text-right mb-2 text-danger remove_tier_bundle"><i class="icon-cross"></i></div>' +
                    '<input type="text" name="bundle_title_tier' + tier + '[]" class="form-control" placeholder="Bundle Title">' +
                    '</div>' +
                    '<input type="file" name="bundle_image_tier' + tier + '[]" class="file-input" accept=".jpg,.png,.jpeg,.gif" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>' +
                    '</div>');
                i++;
                $(this).attr('data-bundle', i);
                $('.file-input').fileinput({
                    browseLabel: 'Browse',
                    previewFileType: 'image',
                    browseIcon: '<i class="icon-image2 mr-2"></i>',
                    initialCaption: "No file selected",
                    fileActionSettings: fileActionSettings
                });
            });
            $(document).on('click', '.remove_tier_bundle', function() {
                var div = $(this).parents('.col-md-4');
                div.remove();
            });

            $('#update_gig').click(function() {
                $('#basic_info_form').submit();
            });

            var old_images = $('.old_image');
            $.each(old_images, function(key, value) {
                $(this).siblings('.file-input').find('img').attr('src', $(this).val());
            });

            var validator = $('#basic_info_form').validate({
                rules: {
                    title: {
                        required: true
                    },
                    category: {
                        required: true
                    },
                    genre: {
                        required: true,
                    },
                    ticket_limit: {
                        required: true,
                    },
                    ticket_limit: {
                        required: true,
                    },
                    threshold: {
                        required: true,
                    },
                    poster: {
                        required: false,
                        accept: "gif|png|jpg|jpeg"
                    },
                    image: {
                        required: false,
                        accept: "gif|png|jpg|jpeg"
                    },
                    bundle_image_tier1: {
                        required: false,
                        accept: "gif|png|jpg|jpeg"
                    },
                    bundle_image_tier2: {
                        required: false,
                        accept: "gif|png|jpg|jpeg"
                    },
                    bundle_image_tier3: {
                        required: false,
                        accept: "gif|png|jpg|jpeg"
                    },
                },
                messages: {
                    title: {
                        required: "Title is required field"
                    },
                    category: {
                        required: "Category is required field"
                    },
                    genre: {
                        required: "Genre is required field",
                    },
                    ticket_limit: {
                        required: "Ticket Goal is required field",
                    },
                    threshold: {
                        required: "Ticket Threshold is required field",
                    },
                    // goal_amount: {
                    //     required: "Goal Amount is required field",
                    // },
                    poster: {
                        required: "This is required field",
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
                    },
                    image: {
                        required: "This is required field",
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
                    },
                    bundle_image_tier1: {
                        required: "This is required field",
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
                    },
                    bundle_image_tier2: {
                        required: "This is required field",
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
                    },
                    bundle_image_tier3: {
                        required: "This is required field",
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
                    },
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function() {
                    document.forms["basic_info_form"].submit();
                }
            });

            $('input').change(function() {
                console.log(this)
                update_gig_data(this);
            })

            function update_gig_data(elem) {
                $.ajax({
                    url: base_url + 'gigs/update_gig_data',
                    data: {
                        id: $('#gig_id').val(),
                        field: elem
                    },
                    dataType: 'json',
                    method: 'POST',
                    success: function(resp) {

                    }
                })
            }

        });
        function initMap()
        {
            const input = document.getElementById("address");
            const options = {
                fields: ["address_components", "geometry", "icon", "name"],
                // strictBounds: false,
                // types: ["establishment"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
        }
    </script>

</body>

</html>