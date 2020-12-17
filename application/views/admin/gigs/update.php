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
                                <li class="nav-item"><a href="#justified-right-icon-tab1" class="nav-link" data-toggle="tab">Basic Info <i class="icon-mic2 ml-2"></i></a></li>
                                <li class="nav-item"><a href="#justified-right-icon-tab2" class="nav-link active" data-toggle="tab">Ticket Tiers <i class="icon-ticket ml-2"></i></a></li>
                                <li class="nav-item"><a href="#justified-right-icon-tab3" class="nav-link" data-toggle="tab">About You <i class="icon-user ml-2"></i></a></li>
                                <!-- <li class="nav-item"><a href="#justified-right-icon-tab4" class="nav-link" data-toggle="tab">Inactive <i class="icon-mention ml-2"></i></a></li> -->
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="justified-right-icon-tab1">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?php echo $gig->id ?>">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Enter address"><?php echo $gig->address ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Goal <span class="text-danger">*</span></label>
                                                        <input type="number" name="goal" id="goal" class="form-control" value="<?php echo $gig->goal ?>" min="0" data-error="#goal1">
                                                        <span id="goal1" class="text-danger" generated="true"><?php echo form_error('goal'); ?></span>
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
                                                        <?php $curr_date = date('Y-m-d'); ?>
                                                        <label>Campaign Launch Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="campaign_date" id="campaign_date" class="form-control" min="<?php echo $curr_date ?>" value="<?php echo date('Y-m-d', strtotime($gig->campaign_date)) ?>">
                                                        <span id="campaign_date1" class="text-danger" generated="true"><?php echo form_error('campaign_date'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gig Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="gig_date" id="gig_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($gig->gig_date)) ?>">
                                                        <span id="gig_date1" class="text-danger" generated="true"><?php echo form_error('gig_date'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Venue</label>
                                                        <br>
                                                        <div class="form-check form-check-switchery form-check-inline">
                                                            <label class="form-check-label">
                                                                Live stream
                                                                <input type="checkbox" class="form-check-input-switchery-primary" name="venues[]" value="live-stream" data-fouc <?php echo in_array('live-stream', $gig->venues) ? 'checked' : '' ?>>
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-switchery form-check-inline">
                                                            <label class="form-check-label">
                                                                Physical
                                                                <input type="checkbox" class="form-check-input-switchery-primary" name="venues[]" value="physical" data-fouc <?php echo in_array('physical', $gig->venues) ? 'checked' : '' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Poster</label>
                                                <input type="hidden" id="old_image" value="<?php echo poster_url() . $gig->poster ?>">
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

                                <div class="tab-pane fade show active" id="justified-right-icon-tab2">
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
                                                                    <label>Quantity</label>
                                                                    <input type="number" class="form-control" placeholder="Enter ticket quantity" name="ticket_quantity[]" min="0" value="<?php echo $ticket->quantity ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>Limit</label>
                                                                    <div class="form-check form-check-switchery">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_limited_<?php echo $tier ?>" value="1" data-fouc <?php echo $ticket->is_limited ? 'checked' : '' ?>>
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
                                                            if (isset($ticket->bundles)) :
                                                                $i = 1;
                                                                foreach ($ticket->bundles as $bundle) :
                                                            ?>
                                                                    <label>Bundle <?php echo $i ?></label>
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-4">
                                                                            <input type="text" name="bundle_name_tier<?php echo $tier ?>[]" class="form-control" placeholder="Bundle Name" value="<?php echo $bundle->name ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" name="bundle_quantity_tier<?php echo $tier ?>[]" class="form-control" placeholder="Bundle Quantity" min="0" value="<?php echo $bundle->quantity ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" name="bundle_price_tier<?php echo $tier ?>[]" class="form-control" placeholder="Ticket Price" min="0" value="<?php echo $bundle->price ?>">
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                endforeach;
                                                            endif;
                                                            ?>

                                                        </div>
                                                        <div class="text-right mt-3">
                                                            <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="<?php echo $tier ?>"><i class="icon-plus3"></i> Add Bundle</button>
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
                                                                <label>Quantity</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket quantity" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Limit</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_limited_1" value="1" data-fouc>
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
                                                                <label>Quantity</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket quantity" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Limit</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_limited_2" value="1" data-fouc>
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
                                                                <label>Quantity</label>
                                                                <input type="number" class="form-control" placeholder="Enter ticket quantity" name="ticket_quantity[]" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Limit</label>
                                                                <div class="form-check form-check-switchery">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input-switchery-primary" name="ticket_is_limited_3" value="1" data-fouc>
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
                                                <textarea name="address" cols="30" rows="3" class="form-control" placeholder="Address"><?php echo $user->address ?></textarea>
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
                                            <input type="hidden" id="old_image" value="<?php echo $user->image ? profile_image_url() . $user->image : '' ?>">
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
                        <button type="submit" class="btn btn-success">Update Gig</button>
                    </div>
                </form>
                <!-- /basic layout -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#sidebar_gig').addClass('nav-item-open');
            $('#sidebar_gig ul').first().css('display', 'block');
            $('#sidebar_gig_view a').addClass('active');

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
                var div = $(this).parents(card).find('.tier_bundles');
                div.append('<label>Bundle ' + i + '</label>' +
                    '<div class="row mb-2">' +
                    '<div class="col-md-4">' +
                    '<input type="text" name="bundle_name_tier' + tier + '[]" class="form-control" placeholder="Bundle Name">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<input type="number" name="bundle_quantity_tier' + tier + '[]" class="form-control" placeholder="Bundle Quantity" min="0">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<input type="number" name="bundle_price_tier' + tier + '[]" class="form-control" placeholder="Ticket Price" min="0">' +
                    '</div>' +
                    '</div>');
                i++;
                $(this).attr('data-bundle', i);
            });

            // var validator = $('#basic_info_form').validate({
            //     rules: {
            //         title: {
            //             required: true
            //         },
            //         category: {
            //             required: true
            //         },
            //         genre: {
            //             required: true,
            //         },
            //         goal: {
            //             required: true,
            //         },
            //         // campaign_date: {
            //         //     required: false,
            //         // },
            //         // gig_date: {
            //         //     required: false,
            //         // },
            //         poster: {
            //             required: false,
            //             accept: "gif|png|jpg|jpeg"
            //         }
            //     },
            //     messages: {
            //         title: {
            //             required: "Title is required field"
            //         },
            //         category: {
            //             required: "Category is required field"
            //         },
            //         genre: {
            //             required: "Genre is required field",
            //         },
            //         goal: {
            //             required: "Goal is required field",
            //         },
            //         // campaign_date: {
            //         //     date: "Campaign Date is required field",
            //         // },
            //         // gig_date: {
            //         //     date: "Gig Date is required field",
            //         // },
            //         poster: {
            //             required: "This is required field",
            //             accept: "Accepts images having extension gif|png|jpg|jpeg"
            //         }
            //     },
            //     errorPlacement: function(error, element) {
            //         var placement = $(element).data('error');
            //         if (placement) {
            //             $(placement).append(error)
            //         } else {
            //             error.insertAfter(element);
            //         }
            //     },
            //     submitHandler: function() {
            //         document.forms["basic_info_form"].submit();
            //     }
            // });
        });
    </script>

</body>

</html>