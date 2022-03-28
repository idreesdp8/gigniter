<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('frontend/layout/meta_tags'); ?>
  <title>Gigniter - Online Ticket Booking Service</title>
  <style>
    .panel>.panel-primary {
      display: none;
    }

    .panel>.active {
      display: block;
    }

    #video {
      border: 0px;
    }

    .align-items-flex-end {
      align-items: flex-end;
    }

    .kv-fileinput-error {
      color: red;
    }

    .btn.disabled2,
    .btn:disabled {
      opacity: 1;
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
    </div>
  </section>
  <!-- ==========Banner-Section========== -->

  <!-- ==========photo-Section========== -->
  <section class="section-margin-top">
    <div class="container main-container">
      <div class="container progress-container">
        <div class="row progress-row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="stepwizard">
              <div class="stepwizard-row row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" type="button" class="btn btn-circle line progress_step_1 btn-success-circle">1</a>
                  <p><small>Basic Info</small></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" type="button" class="btn btn-default btn-circle line progress_step_2 disabled2">2</a>
                  <p><small>Ticket Tiers</small></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" type="button" class="btn btn-default btn-circle line progress_step_3 disabled2">3</a>
                  <p><small>About You</small></p>
                </div>
                <!-- <div class="stepwizard-step">
                  <a href="#step-4" type="button" class="btn btn-default btn-circle line progress_step_4 disabled2">4</a>
                  <p><small>Test link</small></p>
                </div> -->
                <div class="stepwizard-step">
                  <a href="#step-4" type="button" class="btn btn-default btn-circle progress_step_4 disabled2">4</a>
                  <p><small>Review & Confirm</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container step-container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form role="form" method="post" action="<?php echo user_base_url() ?>gigs/update" id="basic_info_form" enctype="multipart/form-data">
              <!-- <div class=""> -->
              <input type="hidden" name="id" id="gig_id" value="<?php echo $gig->id ?>">
              <div class="panel panel-primary setup-content" id="step-1">
                <!-- <form id="form_step_1" enctype="multipart/form-data"> -->
                <div class="step-form-heading">
                  <h6 class="theme-primary-color">Update Gig Details</h6>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig Title <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Title"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="title" name="title" required="required" value="<?php echo $gig->title; ?>">
                      <span id="title1" class="text-danger"><?php echo form_error('title'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig subtitle <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig subtitle"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="subtitle" name="subtitle" required="required" value="<?php echo $gig->subtitle; ?>" />
                      <span id="subtitle1" class="text-danger"><?php echo form_error('subtitle'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Category <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Category"><i class="fas fa-question-circle"></i></span>
                      <select id="category" name="category" class="select" required="required">
                        <option value="">Select Category</option>
                        <?php
                        if (isset($categories)) {
                          foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->value; ?>" <?php echo ($gig->category == $category->value) ? 'selected="selected"' : ''; ?>><?php echo $category->label; ?></option>
                        <?php
                          }
                        } ?>
                      </select>
                      <span id="category1" class="text-danger"><?php echo form_error('category'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Genre <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Genre"><i class="fas fa-question-circle"></i></span>
                      <select id="genre" name="genre" class="select" required="required">
                        <option value="">Select Genre</option>
                        <?php
                        if (isset($genres)) {
                          foreach ($genres as $genre) { ?>
                            <option value="<?php echo $genre->value ?>" <?php echo ($gig->genre == $genre->value) ? 'selected="selected"' : ''; ?>> <?php echo $genre->label; ?> </option>
                        <?php
                          }
                        } ?>
                      </select>
                      <span id="genre1" class="text-danger"><?php echo form_error('genre'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>Venue <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Venues"><i class="fas fa-question-circle"></i></span>
                      <div class="d-flex">
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-live_stream" name="venues[]" value="Live stream" type="checkbox" <?php echo (in_array('Live stream', $gig->venues)) ? 'checked="checked"' : ''; ?>>
                            <label for="myCheckbox-live_stream">Live stream</label>
                            <span></span>
                          </div>
                        </div>
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-physical" name="venues[]" value="Physical" type="checkbox" <?php echo (in_array('Physical', $gig->venues)) ? 'checked="checked"' : ''; ?>>
                            <label for="myCheckbox-physical">Physical</label>
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="div_image">
                    <p><i class="fas fa-images"></i> Upload Gig Poster <small class="text-warning">min 360px x 354px</small> <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Poster"><i class="fas fa-question-circle"></i></span></p>
                    <!-- or Pitch Video -->
                    <div style="height:200px;" class="gig-poster-wrapper">
                      <div class="mb-1">
                        <label style="z-index: 3;left: 50%;position: absolute;top: 50%;float: left;width: 50px;" class="icon_upload1 file-dimension custom-file-upload" for="file-input">
                          <img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" class="icon_upload2">
                        </label>
                        <input type="hidden" name="old_poster" class="old_poster" value="<?php echo (isset($gig->poster) && strlen($gig->poster) > 0) ? poster_url() . $gig->poster : ''; ?>">
                        <!-- <input id="file-input" type="file" name="poster" class="file-input" accept="image/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc> -->
                        <input id="file-input" type="file" name="poster" class="file-input" accept="image/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                      </div>
                    </div>
                    <div class="error_poster text-danger"></div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="div_video">
                    <p><i class="fas fa-video"></i> Upload Pitch Video <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig pitch video"><i class="fas fa-question-circle"></i></span></p>
                    <!-- or Pitch Video -->
                    <div class="gig-poster-wrapper">
                      <div class="mb-1 video-wrapper">
                        <img alt="your image" class="d-none" />
                        <label style="z-index: 999;left: 50%;position: absolute;top: 50%;display: inline-flex;" class="icon_upload1 file-dimension custom-file-upload" for="file-input1">
                          <img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" class="icon_upload2">
                        </label>
                        <input type="hidden" name="old_video" class="old_video" value="<?php echo (isset($gig->video) && strlen($gig->video) > 0) ? video_url() . $gig->video : ''; ?>">
                        <input id="file-input1" type="file" name="video" class="file-input" accept="video/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="gig_address" style="display: none">
                    <label> Enter Address <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Address"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="address" name="address" value="<?php echo $gig->address; ?>">
                      <span id="address1" class="text-danger"><?php echo form_error('address'); ?></span>
                    </label>
                  </div>
                  <!-- <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div> -->
                  <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Enter Gig Details</h6>
                    </div>
                  </div> -->
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Target Number of Tickets <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Target Number of Tickets"><i class="fas fa-question-circle"></i></span>
                      <input type="number" id="goal" name="goal" min="1" required="required" value="<?php echo $gig->ticket_limit ?>" <?php echo $gig->status ? 'disabled' : '' ?>>
                      <span id="goal1" class="text-danger"><?php echo form_error('goal'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Ticket Threshold <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Ticket Threshold. It must be less than Target number of tickets."><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="threshold" name="threshold" readonly required="required" value="<?php echo $gig->threshold ?>">
                      <span id="threshold1" class="text-danger"><?php echo form_error('threshold'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex align-items-flex-end">
                    <label>
                      <div class="mycheckbox-contain">
                        <div class="allow-overshoot">
                          <input id="myCheckbox-allow_overshoot" type="checkbox" name="is_overshoot" value="1" <?php echo ($gig->is_overshoot) ? 'checked="checked"' : ''; ?>>
                          <label for="myCheckbox-allow_overshoot">Allow overshoot</label>
                          <span></span>
                        </div>
                        <span id="is_overshoot1" class="text-danger"><?php echo form_error('is_overshoot'); ?></span>
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <!-- <label>
                      Target Goal Amount <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Target Goal Amount"><i class="fas fa-question-circle"></i></span>
                      <input type="number" id="goal_amount" name="goal_amount" min="1" required="required" value="<?php echo $gig->goal_amount ?>">
                      <span id="goal_amount1" class="text-danger" ><?php echo form_error('goal_amount'); ?></span>
                    </label> -->
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      <?php $curr_date = date('Y-m-d'); ?>
                      Campaign Launch Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Campaign Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="campaign_date" class="date" name="campaign_date" min="<?php echo $gig->campaign_date ? date('Y-m-d', strtotime($gig->campaign_date)) : date('Y-m-d', strtotime('now')) ?>" onFocus="(this.type='date')" onBlur="if(!this.value)this.type='text'" required="required" value="<?php echo $gig->campaign_date ? date('Y-m-d', strtotime($gig->campaign_date)) : '' ?>">
                      <span id="campaign_date1" class="text-danger"><?php echo form_error('campaign_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Gig Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="gig_date" class="date" name="gig_date" onFocus="(this.type='date')" onBlur="if(!this.value)this.type='text'" required="required" value="<?php echo $gig->gig_date ? date('Y-m-d', strtotime($gig->gig_date)) : '' ?>" min="<?php echo $gig->campaign_date ? date('Y-m-d', strtotime($gig->campaign_date)) : date('Y-m-d', strtotime('now')) ?>">
                      <span id="gig_date1" class="text-danger"><?php echo form_error('gig_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Start Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Start Time"><i class="fas fa-question-circle"></i></span>
                      <input type="time" id="start_time" class="time" name="start_time" onFocus="(this.type='time')" onBlur="if(!this.value)this.type='text'" required="required" value="<?php echo $gig->start_time ? date('H:i:s', strtotime($gig->start_time)) : '' ?>">
                      <span id="start_time1" class="text-danger"><?php echo form_error('start_time'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      End Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig End Time"><i class="fas fa-question-circle"></i></span>
                      <input type="datetime-local" id="end_time" class="time" name="end_time" onFocus="(this.type='datetime-local')" onBlur="if(!this.value)this.type='text'" required="required" min="<?php echo date('Y-m-d', strtotime($gig->gig_date)) . 'T' . date('H:i:s', strtotime($gig->start_time)) ?>" value="<?php echo $gig->end_time ? date('Y-m-d\TH:i:s', strtotime($gig->end_time)) : '' ?>">
                      <span id="end_time1" class="text-danger"><?php echo form_error('end_time'); ?></span>
                    </label>
                  </div>
                  <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  </div> -->
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">Save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-2">
                <!-- <form id="form_step_2" enctype="multipart/form-data"> -->
                <!-- <div class="step-form-heading">
                    <h6>Enter Gig Tiers</h6>
                  </div> -->
                <div class="row" id="ticket_tiers">
                  <?php
                  $tier = 1;
                  if (isset($tickets) && !empty($tickets)) {
                    foreach ($tickets as $ticket) { ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                        <div id="tier<?php echo $tier ?>">
                          <h5>Tier <?php echo $tier ?> </h5>
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                              <input type="hidden" name="ticket_id[]" value="<?php echo $ticket->id; ?>">
                              <label> Tier Name
                                <input type="text" name="ticket_name[]" value="<?php echo $ticket->name; ?>" placeholder="">
                              </label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                              <label> Tier Price
                                <input type="text" name="ticket_price[]" value="<?php echo $ticket->price; ?>" placeholder="USD $">
                              </label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                              <label> Number of tickets in Tier
                                <input type="text" name="ticket_quantity[]" value="<?php echo $ticket->quantity; ?>" placeholder="">
                              </label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <label> Description
                                <textarea name="ticket_description[]" cols="30" rows="2"><?php echo $ticket->description; ?></textarea>
                              </label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">
                              <?php
                              $i = 1;
                              if (isset($ticket->bundles) && !empty($ticket->bundles)) {
                              ?>
                                <label class="">
                                  Products
                                  <div class="row mb-2">
                                    <?php
                                    foreach ($ticket->bundles as $bundle) {
                                    ?>
                                      <div class="col-md-4">
                                        <div class="cursor-pointer text-right mb-2 text-danger remove_tier_bundle"><i style="font-size: 18px;border: 1px solid;padding: 3px;" class="fas fa-times"></i></div>
                                        <div class="form-group">
                                          <input type="text" name="bundle_title_tier<?php echo $tier; ?>[]" placeholder="Bundle Title" value="<?php echo $bundle->title; ?>">
                                        </div>
                                        <!-- <input type="hidden" class="old_image" value="<?php //echo bundle_url() . $bundle->image 
                                                                                            ?>"> -->
                                        <input type="hidden" name="old_bundle_image_tier<?php echo $tier; ?>[]" value="<?php echo $bundle->image; ?>">
                                        <div class="add-product-border image_div mb-0"> <img class="icon_upload2" src="<?php echo $bundle->image ? bundle_url() . $bundle->image : ''; ?>" alt="your image" /> </div>
                                        <input class="file-upload2" type='file' name="bundle_image_tier<?php echo $tier ?>[]" accept="image/*" onChange="read_bundle_image(this);" />
                                        <!-- <input type="file" name="bundle_image_tier<?php //echo $tier
                                                                                        ?>[]" class="file-input-preview" accept=".jpg,.png,.jpeg,.gif" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc> -->
                                      </div>
                                    <?php
                                      $i++;
                                    } ?>
                                  </div>
                                </label>
                              <?php
                              } else { ?>
                                <label class="d-none">
                                  Products
                                  <div class="row mb-2"> </div>
                                </label>
                              <?php } ?>
                            </div>
                            <div class="col-lg-12 col-md-4 col-sm-12 col-12">
                              <button id="add-product-btn" type="button" class="btn btn-secondary add_tier_bundle mob-width w-25 " data-bundle="<?php echo $i; ?>" data-tier="<?php echo $tier; ?>">Add Product</button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                              <div class="mycheckbox-contain">
                                <div class="allow-overshoot">
                                  <input id="myCheckbox-ticket_is_unlimited_<?php echo $tier; ?>" type="checkbox" name="ticket_is_unlimited_<?php echo $tier; ?>" value="1" <?php echo $ticket->is_unlimited ? 'checked' : ''; ?>>
                                  <label for="myCheckbox-ticket_is_unlimited_<?php echo $tier; ?>">No Limit</label>
                                  <span></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                          </div>
                        </div>
                      </div>

                    <?php
                      $tier++;
                    }
                  } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                      <div id="tier1">
                        <h5 class="theme-primary-color">Tier 1</h5>
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <label>
                              Tier Name
                              <input type="text" name="ticket_name[]" placeholder="">
                            </label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <label>
                              Tier Price
                              <input type="number" name="ticket_price[]" placeholder="USD $" min="1">
                            </label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <label>
                              Number of tickets in Tier
                              <input type="number" name="ticket_quantity[]" placeholder="" value="1" min="1">
                            </label>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <label>
                              Description
                              <textarea name="ticket_description[]" cols="30" rows="2"></textarea>
                            </label>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">
                            <label class="d-none mb-0">
                              Products
                              <div class="row mb-2">
                              </div>
                            </label>
                          </div>
                          <div class="col-lg-12 col-md-4 col-sm-12 col-12">
                            <button type="button" class="btn btn-secondary add_tier_bundle mob-width w-25" data-bundle="1" data-tier="1">Add Product</button>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mycheckbox-contain">
                              <div class="allow-overshoot">
                                <input id="myCheckbox-ticket_is_unlimited_1" type="checkbox" name="ticket_is_unlimited_1" value="1">
                                <label for="myCheckbox-ticket_is_unlimited_1">No Limit</label>
                                <span></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                          <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
							  </div> -->
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>

                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <button type="button" class="teir-button btn btn-primary" id="add_tier_button" data-tier="2">Add Tier</button>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">Save & Continue</button>
                  </div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-3">
                <div class="step-form-heading">
                  <h6 class="theme-primary-color">Build Your Profile</h6>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Profile Image
                      <div> <img id="img2" src="<?php echo $user->image ? profile_image_url() . $user->image : user_asset_url() . 'images/icons/img-demo-bg.png' ?>" alt="your image" /> <a><img src="<?php echo $user->image ? '' : user_asset_url() . 'images/icons/img-plus.png' ?>" id="icon_for_upload"></a>
                        <input type='file' id="my-file2" name="image" hidden="hidden" accept="image/*" onChange="readURL2(this);" />
                      </div>

                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      First Name
                      <input type="text" id="fname" name="fname" value="<?php echo isset($user->fname) ? $user->fname : ''; ?>" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Last Name
                      <input type="text" id="lname" name="lname" value="<?php echo isset($user->lname) ? $user->lname : ''; ?>" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Email
                      <?php
                      if ($this->session->userdata('us_id')) :
                      ?>
                        <div><?php echo isset($user->email) ? $user->email : ''; ?></div>
                      <?php
                      else :
                      ?>
                        <input type="email" id="email" name="email" required="required">
                        <span class="email_error text-danger"></span>
                      <?php
                      endif;
                      ?>
                    </label>
                  </div>
                  <?php
                  if (!isset($user)) :
                  ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <label>
                        Password
                        <input type="password" id="password" name="password" required="required">
                      </label>
                    </div>
                  <?php
                  else :
                  ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <?php
                  endif;
                  ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Bio
                      <textarea style="height:150px;" type="text" id="description" name="description" class="textarea" rows="2"><?php echo isset($user->description) ? $user->description : ''; ?></textarea>
                    </label>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Address
                      <input type="text" id="user_address" name="user_address" value="<?php echo isset($user->address) ? $user->address : ''; ?>">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Location
                      <select name="country_id" id="country_id">
                        <option value="">Choose Country</option>
                        <?php
                        if ($countries) {
                          foreach ($countries as $country) { ?>
                            <option value="<?php echo $country->id ?>" <?php echo isset($user->country_id) && $country->id == $user->country_id ? 'selected="selected"' : ''; ?>><?php echo $country->name; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Social urls
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Email
                            <input type="text" class="social_url" name="mail" id="mail" value="<?php echo $link[0]['mail'] ?? ''; ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Facebook
                            <input type="text" class="social_url" name="facebook" id="facebook" value="<?php echo $link[1]['facebook'] ?? ''; ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Instagram
                            <input type="text" class="social_url" name="instagram" id="instagram" value="<?php echo $link[2]['instagram'] ?? ''; ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Twitter
                            <input type="text" class="social_url" name="twitter" id="twitter" value="<?php echo $link[3]['twitter'] ?? ''; ?>">
                          </label>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Stripe integration
                      <input type="text" id="stripe" name="stripe" value="<?php echo (isset($user->stripe) && $user->stripe != '') ? $user->stripe : ''; ?>" required="required" />
                    </label>
                  </div>
                  <div class=" col-lg-6 col-md-6 col-sm-12 col-12">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">Save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-4">
                <div class="row justify-content-center">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-buttons">
                      <input type="hidden" name="is_draft" id="is_draft">
                      <?php
                      if ($gig->is_complete) :
                      ?>
                        <button type="submit" class="btn btn-primary btn-step-continue" id="submit_button">Update Gig</button>
                      <?php
                      else :
                      ?>
                        <button type="submit" class="btn-theme-primary btn ml-3" onClick="submit_form(1)">Save as Draft</button>
                        <?php
                        if (!$prev_submitted) :
                        ?>
                          <button type="submit" class="btn btn-success ml-3" onClick="submit_form(0)">Submit for Approval</button>
                      <?php
                        endif;
                      endif;
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ==========photo-Section========== -->
  <!-- /page content -->

  <?php $this->load->view('frontend/layout/newsletter_footer'); ?>
  <?php $this->load->view('frontend/layout/scripts'); ?>
  <?php
  // if ($gig->is_complete) :
  ?>
  <script src="<?php echo user_asset_url(); ?>js/step-form-update.js"></script>
  <?php
  // else :
  ?>
  <!-- <script src="<?php echo user_asset_url(); ?>js/step-form2.js"></script> -->
  <?php
  // endif;
  ?>
  <script src="<?php echo user_asset_url(); ?>js/upload-gig-img.js"></script>
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
  <!-- <script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/uploader_bootstrap.js"></script> -->
  <script>
    function submit_form(val) {
      $('#is_draft').val(val);
    }

    $(document).ready(function() {
      var image = $('.old_poster').val();
      // console.log(image);
      var video = $('.old_video').val();
      var label = '';
      var label1 = '';
      if (image) {
        label = 'Change';
      } else {
        label = 'Upload';
      }
      if (video) {
        label1 = 'Change';
      } else {
        label1 = 'Upload';
      }

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
      $('#file-input').fileinput({
        browseLabel: label,
        browseIcon: '<i class="icon-file-plus mr-2"></i>',
        initialPreview: [
          image,
        ],
        initialPreviewAsData: true,
        overwriteInitial: true,
        fileActionSettings: fileActionSettings
      });

      $('#file-input1').fileinput({
        browseLabel: label1,
        browseIcon: '<i class="icon-file-plus mr-2"></i>',
        initialPreview: [
          video,
        ],
        initialPreviewFileType: 'video',
        initialPreviewAsData: true,
        overwriteInitial: true,
        fileActionSettings: fileActionSettings
      });

      $('.file-preview-video source').attr('type', 'video/mp4')

      $('#campaign_date').change(function() {
        var campaign_date = new Date($(this).val());
        var gig_min_date = campaign_date.toISOString().substring(0, 10);
        var gig_min_value = new Date(campaign_date.setDate(parseInt(campaign_date.getDate()) + parseInt(<?php echo $buffer_days; ?>)));
        var gig_max_date = new Date(campaign_date.setDate(campaign_date.getDate() + 30));
        gig_max_date = gig_max_date.toISOString().substring(0, 10);
        gig_min_value = gig_min_value.toISOString().substring(0, 10);
        var gig_min_time = campaign_date.toISOString().substring(10, 16);
        // console.log(gig_min_date)
        // console.log(gig_min_time)
        if ($('#start_time').val() != '') {
          gig_min_time = 'T' + $('#start_time').val();
        }
        console.log(gig_max_date);
        console.log(gig_min_value);
        $('#gig_date').attr('min', gig_min_value);
        $('#gig_date').val(gig_min_value);
        $('#gig_date').attr('max', gig_max_date);
        set_end_time_min(gig_min_value, gig_min_time)
      });

      $('#gig_date').change(function() {
        var gig_date = new Date($(this).val()).toISOString();
        var gig_min_date = gig_date.substring(0, 10);
        var gig_min_time = gig_date.substring(10, 16);
        console.log(gig_min_date)
        console.log(gig_min_time)
        if ($('#start_time').val() != '') {
          gig_min_time = 'T' + $('#start_time').val();
        }
        set_end_time_min(gig_min_date, gig_min_time)
      })

      $('#start_time').change(function() {
        var gig_min_date = new Date().toISOString().substring(0, 10)
        if ($('#gig_date').val() != '') {
          gig_min_date = new Date($('#gig_date').val()).toISOString().substring(0, 10);
        }
        var gig_min_time = 'T' + $(this).val();
        set_end_time_min(gig_min_date, gig_min_time)
      })

      function set_end_time_min(gig_min_date, gig_min_time) {
        var end_time_min = gig_min_date + gig_min_time
        console.log(end_time_min)
        $('#end_time').attr('min', end_time_min);
      }

      $('#add_tier_button').click(function() {
        var tier = $(this).data('tier');
        var div = $('#ticket_tiers');
        div.append('<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">' +
          '<div id="tier' + tier + '">' +
          '<h5>Tier ' + tier + '</h5>' +
          '<div class="row">' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Tier Name<input type="text" name="ticket_name[]" placeholder=""></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Tier Price<input type="text" name="ticket_price[]" placeholder="USD $"></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Number of tickets in Tier<input type="text" name="ticket_quantity[]" placeholder=""></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12">' +
          '<label>Description<textarea name="ticket_description[]" cols="30" rows="2"></textarea></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">' +
          '<label class="d-none">Products<div class="row mb-2"></div></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-4 col-sm-12 col-12">' +
          '<button  id="add-product-btn" type="button" class="btn btn-secondary add_tier_bundle mob-width w-25" data-bundle="1" data-tier="' + tier + '">Add Product</button>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<div class="mycheckbox-contain">' +
          '<div class="allow-overshoot">' +
          '<input id="myCheckbox-ticket_is_unlimited_' + tier + '" type="checkbox" name="ticket_is_unlimited_' + tier + '" value="1">' +
          '<label for="myCheckbox-ticket_is_unlimited_' + tier + '">No Limit</label><span></span>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>' +
          '</div>' +
          '</div>' +
          '</div>'
        );
        $(this).data('tier', tier + 1);
      });

      $('#myCheckbox-allow_overshoot').click(function() {
        if ($(this).is(':checked')) {

        } else {
          swal({
            title: "Are you sure you want to proceed without allow overshoot?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["No", "Yes"],
          }).then((willDelete) => {
            if (willDelete) {
              $(this).prop('checked', false)
            } else {
              $(this).prop('checked', true)
            }
          });
        }
      })

      $('#start_gig_menu').addClass('active');



      $('#add_tier_button').click(function() {});

      $(document).on('click', '.add_tier_bundle', function() {
        var i = $(this).attr('data-bundle');
        var tier = $(this).data('tier');
        var div = '#tier' + tier;
        var label = $(this).parents(div).find('.tier_bundles label');
        label.removeClass('d-none');
        var div = $(this).parents(div).find('.tier_bundles .row');
        var foo = "<?php echo user_asset_url(); ?>images/icons/img-plus.png";
        div.append(
          '<div class="col-md-4">' +
          '<div class = "cursor-pointer text-right mb-2 text-danger remove_tier_bundle"><i style="font-size: 18px;border: 1px solid;padding: 3px;" class="fas fa-times"></i></div>' +
          '<div class="form-group mt-3">' +
          '<input type="text" name="bundle_title_tier' + tier + '[]" placeholder="Bundle Title">' +
          '</div>' +
          '<div class="image_div mb-1">' +
          '<img alt="your image" class="d-none" />' +
          '</div>' +
          '<label class="icon_upload1" for="file-upload2" class="file-dimension custom-file-upload">' +
          '<img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" class="icon_upload2">' +
          '</label>' +
          '<input class="file-upload2" type="file" name="bundle_image_tier' + tier + '[]" accept="image/*" onchange="read_bundle_image(this);" />' +
          '</div>');
        i++;
        $(this).attr('data-bundle', i);
      });

      $(document).on('click', '.image_div', function() {
        var div = $(this).parents('.col-md-4');
        div.find('.file-upload2').trigger('click');
      });
      $(document).on('click', '.icon_upload1 img', function() {
        var div = $(this).parents('.col-md-4');
        div.find('.file-upload2').trigger('click');
      });
      $(document).on('click', '.remove_tier_bundle', function() {
        var div = $(this).parents('.col-md-4');
        div.remove();
      });
      $(document).on('click', '.remove_tier', function() {
        var div = $(this).parents('.ticket_tier');
        var tier = div.children().first().attr('id');
        $('#gig_' + tier).parent().remove();
        div.remove();
      });
      $(document).on('click', '#div_image .fileinput-remove > span', function() {
        $('.old_poster').val('')
      })
      $(document).on('click', '#div_video .fileinput-remove > span', function() {
        $('.old_video').val('')
      })

      $('#myCheckbox-physical').click(function() {
        console.log($(this).is(':checked'))
        if ($(this).is(':checked')) {
          $('#gig_address').show('slow')
        } else {
          $('#gig_address').hide('slow')
        }
      })
    });
    $('#goal').change(function() {
      var goal = $(this).val();
      var threshold = Math.round(goal * <?php echo $threshold_value->value ?>);
      $('#threshold').val(threshold);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#img').attr('src', e.target.result);
          $('#gig_poster').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>