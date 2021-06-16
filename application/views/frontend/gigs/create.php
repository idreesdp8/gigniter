<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('frontend/layout/meta_tags'); ?>
  <title>Gigniter - Online Ticket Booking Website HTML Template</title>
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
                  <a href="#step-2" type="button" class="btn btn-default btn-circle line progress_step_2">2</a>
                  <p><small>Ticket Tiers</small></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" type="button" class="btn btn-default btn-circle line progress_step_3">3</a>
                  <p><small>About You</small></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-4" type="button" class="btn btn-default btn-circle line progress_step_4">4</a>
                  <p><small>Test link</small></p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-5" type="button" class="btn btn-default btn-circle progress_step_5">5</a>
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
            <form role="form" method="post" action="<?php echo user_base_url() ?>gigs/add" id="basic_info_form" enctype="multipart/form-data">
              <!-- <div class=""> -->
              <div class="panel panel-primary setup-content" id="step-1">
                <!-- <form id="form_step_1" enctype="multipart/form-data"> -->
                <div class="step-form-heading">
                  <h6 class="theme-primary-color">Enter Gig Details</h6>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig Title <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Title"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="title" name="title" required="required">
                      <span id="title1" class="text-danger" generated="true"><?php echo form_error('title'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig subtitle <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig subtitle"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="subtitle" name="subtitle" required="required">
                      <span id="subtitle1" class="text-danger" generated="true"><?php echo form_error('subtitle'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Category <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Category"><i class="fas fa-question-circle"></i></span>
                      <select id="category" name="category" class="select" required="required">
                        <option value="">Select Category</option>
                        <?php
                        if (isset($categories)) :
                          foreach ($categories as $category) :
                        ?>
                            <option value="<?php echo $category->value ?>"><?php echo $category->label ?></option>
                        <?php
                          endforeach;
                        endif;
                        ?>
                      </select>
                      <span id="category1" class="text-danger" generated="true"><?php echo form_error('category'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Genre <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Genre"><i class="fas fa-question-circle"></i></span>
                      <select id="genre" name="genre" class="select" required="required">
                        <option value="">Select Genre</option>
                        <?php
                        if (isset($genres)) :
                          foreach ($genres as $genre) :
                        ?>
                            <option value="<?php echo $genre->value ?>"><?php echo $genre->label ?></option>
                        <?php
                          endforeach;
                        endif;
                        ?>
                      </select>
                      <span id="genre1" class="text-danger" generated="true"><?php echo form_error('genre'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>Venue <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Venues"><i class="fas fa-question-circle"></i></span>
                      <div class="d-flex">
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-live_stream" name="venues[]" value="Live stream" type="checkbox">
                            <label for="myCheckbox-live_stream">Live stream</label>
                            <span></span>
                          </div>
                        </div>
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-physical" name="venues[]" value="Physical" type="checkbox">
                            <label for="myCheckbox-physical">Physical</label>
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                  <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>Poster Pitch <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Poster Pitch selection"><i class="fas fa-question-circle"></i></span>
                      <div class="d-flex">
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-image" name="poster_pitch" value="image" type="radio">
                            <label for="myCheckbox-image">Image</label>
                            <span></span>
                          </div>
                        </div>
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-video" name="poster_pitch" value="video" type="radio">
                            <label for="myCheckbox-video">Video</label>
                            <span></span>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-9 col-md-8 col-sm-12 col-12">
                  </div> -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="div_image">
                    <p>Upload Gig Poster <small class="text-warning">min 360px x 354px</small> <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Poster"><i class="fas fa-question-circle"></i></span></p>
                    <!-- or Pitch Video -->
                    <div style="height:200px;" class="gig-poster-wrapper">
                      <div class="mb-1">

                        <label style="z-index: 3;left: 50%;position: absolute;top: 50%;float: left;width: 50px;" class="icon_upload1 file-dimension custom-file-upload" for="file-input" class="">
                          <img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" class="icon_upload2">
                        </label>
                        <input id="file-input" type="file" name="poster" class="file-input" accept="image/*" required="required" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                      </div>
                      <!-- <img class="object-fit-cover" id="img" src="<?php echo user_asset_url(); ?>images/icons/img-demo-bg.png" alt="your image" />
                        <a><img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icons_upload"></a>
                        <input type='file' name="poster" id="poster" hidden="hidden" accept="image/*" onchange="readURL(this);" /> -->
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="div_video">
                    <p>Upload Pitch Video <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig pitch video"><i class="fas fa-question-circle"></i></span></p>
                    <!-- or Pitch Video -->
                    <div class="gig-poster-wrapper">
                      <div class="mb-1 video-wrapper">
                        <img alt="your image" class="d-none" />
                        <label style="z-index: 999;left: 50%;position: absolute;top: 50%;display: inline-flex;" class="icon_upload1 file-dimension custom-file-upload" for="file-input1" class="">
                          <img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" class="icon_upload2">
                        </label>
                        <input id="file-input1" type="file" name="video" class="file-input" accept="video/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="gig_address" style="display: none">
                    <label>
                      Enter Address <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Address"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="address" name="address">
                      <span id="address1" class="text-danger" generated="true"><?php echo form_error('address'); ?></span>
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
                      <input type="number" id="goal" name="goal" min="1" required="required">
                      <span id="goal1" class="text-danger" generated="true"><?php echo form_error('goal'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Ticket Threshold <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Ticket Threshold. It must be less than Target number of tickets."><i class="fas fa-question-circle"></i></span>
                      <input type="number" id="threshold" name="threshold" min="1" required="required">
                      <span id="threshold1" class="text-danger" generated="true"><?php echo form_error('threshold'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Target Goal Amount <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Target Goal Amount"><i class="fas fa-question-circle"></i></span>
                      <input type="number" id="goal_amount" name="goal_amount" min="1" required="required">
                      <span id="goal_amount1" class="text-danger" generated="true"><?php echo form_error('goal_amount'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      <?php $curr_date = date('Y-m-d'); ?>
                      Campaign Launch Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Campaign Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="campaign_date" class="date" name="campaign_date" min="<?php echo $curr_date ?>" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="campaign_date1" class="text-danger" generated="true"><?php echo form_error('campaign_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Gig Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="gig_date" class="date" name="gig_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="gig_date1" class="text-danger" generated="true"><?php echo form_error('gig_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Start Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Start Time"><i class="fas fa-question-circle"></i></span>
                      <input type="time" id="start_time" class="time" name="start_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="start_time1" class="text-danger" generated="true"><?php echo form_error('start_time'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      End Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig End Time"><i class="fas fa-question-circle"></i></span>
                      <input type="time" id="end_time" class="time" name="end_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="end_time1" class="text-danger" generated="true"><?php echo form_error('end_time'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="mycheckbox-contain">
                      <div class="allow-overshoot">
                        <input id="myCheckbox-allow_overshoot" type="checkbox" name="is_overshoot" value="1">
                        <label for="myCheckbox-allow_overshoot">Allow overshoot</label>
                        <span></span>
                      </div>
                      <span id="is_overshoot1" class="text-danger" generated="true"><?php echo form_error('is_overshoot'); ?></span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
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
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 order-first order-md-last col-md-9 col-sm-12 col-12">
                    <button type="button" class="teir-button btn btn-primary" id="add_tier_button" data-tier="2">Add Tier</button>
                  </div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-3">
                <!-- <form id="form_step_3" enctype="multipart/form-data"> -->
                <div class="step-form-heading">
                  <h6 class="theme-primary-color">Build Your Profile</h6>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Profile Image
                      <div>
                        <img id="img2" src="<?php echo isset($user) && $user->image ? profile_image_url() . $user->image : user_asset_url() . 'images/icons/img-demo-bg.png' ?>" alt="your image" />
                        <a><img src="<?php echo isset($user) && $user->image ? '' : user_asset_url() . 'images/icons/img-plus.png' ?>" id="icon_for_upload"></a>
                        <input type='file' id="my-file2" name="image" hidden="hidden" accept="image/*" onchange="readURL2(this);" />
                      </div>

                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      First Name
                      <input type="text" id="fname" name="fname" value="<?php echo isset($user) ? $user->fname : null ?>">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Last Name
                      <input type="text" id="lname" name="lname" value="<?php echo isset($user) ? $user->lname : null ?>">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Email
                      <input type="email" id="email" name="email" value="<?php echo isset($user) ? $user->email : null ?>">
                    </label>
                  </div>
                  <?php
                  if (!isset($user)) :
                  ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                      <label>
                        Password
                        <input type="password" id="password" name="password">
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
                      <textarea style="height:150px;" type="text" id="description" name="description" class="textarea" rows="2"><?php echo isset($user) ? $user->description : null ?></textarea>
                    </label>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Address
                      <input type="text" id="user_address" name="user_address" value="<?php echo isset($user) ? $user->address : null ?>">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Location
                      <select name="country_id" id="country_id">
                        <option value="">Choose Country</option>
                        <?php
                        foreach ($countries as $country) :
                        ?>
                          <option value="<?php echo $country->id ?>" <?php echo isset($user) && $country->id == $user->country_id ? 'selected' : '' ?>><?php echo $country->name ?></option>
                        <?php
                        endforeach;
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
                            <input type="text" class="social_url" name="mail" id="mail" value="<?php echo $link[0]['mail'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Facebook
                            <input type="text" class="social_url" name="facebook" id="facebook" value="<?php echo $link[1]['facebook'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Instagram
                            <input type="text" class="social_url" name="instagram" id="instagram" value="<?php echo $link[2]['instagram'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            Twitter
                            <input type="text" class="social_url" name="twitter" id="twitter" value="<?php echo $link[3]['twitter'] ?? null ?>">
                          </label>
                        </div>
                      </div>
                    </label>
                  </div>
                  <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Stripe integration
                      <input type="text" id="stripe_integration" name="stripe_integration">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div> -->
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-4">
                <!-- <form id="form_step_3"> -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6 class="theme-primary-color">Test Links</h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Select the meeting platform
                      <select id="meeting_platform" name="meeting_platform" class="select">
                        <option value="google">Google Meeting</option>
                        <option value="zoom">Zoom Meeting</option>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter url
                      <input type="text" id="meeting_url" name="meeting_url">
                    </label>
                  </div>
                  <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-launch">Launch campaign</button>
                  </div> -->
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-test">test</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-5">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-buttons">
                      <input type="hidden" name="is_draft" id="is_draft">
                      <button type="submit" class="btn-theme-primary btn" formtarget="_blank" onclick="submit_form(2)">Preview</button>
                      <button type="submit" class="btn-theme-primary btn ml-3" onclick="submit_form(1)">Save as Draft</button>
                      <?php
                      if ($gig) :
                      ?>
                        <button type="submit" class="btn btn-success ml-3" onclick="submit_form(0)">Submit for Approval</button>
                      <?php
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
  <!-- <script src="<?php echo user_asset_url(); ?>js/step-form.js"></script> -->
  <script src="<?php echo user_asset_url(); ?>js/step-form.js"></script>
  <script src="<?php echo user_asset_url(); ?>js/upload-gig-img.js"></script>
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
  <script src="<?php echo admin_asset_url(); ?>global_assets/js/demo_pages/uploader_bootstrap.js"></script>
  <script>
    function submit_form(val) {
      $('#is_draft').val(val);
    }

    $(document).ready(function() {

      $('#start_gig_menu').addClass('active');

      // $('input[type=radio]').change(function() {
      //   var selected_radio = $(this).val();
      //   console.log(selected_radio)
      //   if (selected_radio == 'image') {
      //     $('#div_image').fadeIn();
      //     $('#div_video').fadeOut();
      //   } else {
      //     $('#div_image').fadeOut();
      //     $('#div_video').fadeIn();
      //   }
      // })

      $('#campaign_date').change(function() {
        var campaign_date = new Date($(this).val());
        var gig_min_date = campaign_date.toISOString().substring(0, 10);
        var gig_date_value = new Date(campaign_date.setDate(campaign_date.getDate() + 1));
        var gig_max_date = new Date(campaign_date.setDate(campaign_date.getDate() + 30));
        gig_max_date = gig_max_date.toISOString().substring(0, 10);
        gig_date_value = gig_date_value.toISOString().substring(0, 10);
        console.log(gig_max_date);
        console.log(gig_date_value);
        $('#gig_date').attr('min', gig_min_date);
        $('#gig_date').val(gig_date_value);
        $('#gig_date').attr('max', gig_max_date);
      });

      $('#add_tier_button').click(function() {
        var tier = $(this).attr('data-tier');
        var div = $('#ticket_tiers');
        div.append(
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3 ticket_tier">' +
          '<div id="tier' + tier + '">' +
          '<div class="d-flex justify-content-between">' +
          '<h5>Tier ' + tier + '</h5>' +
          '<div class="text-danger cursor-pointer remove_tier"><i class="fas fa-times"></i></div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Tier Name<input type="text" name="ticket_name[]" placeholder=""></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Tier Price<input type="number" name="ticket_price[]" placeholder="USD $" min="1"></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Number of tickets in Tier<input type="number" name="ticket_quantity[]" placeholder=""></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12">' +
          '<label>Description<textarea name="ticket_description[]" cols="30" rows="2"></textarea></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">' +
          '<label class="d-none mb-0">Products<div class="row mb-2"></div></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-4 col-sm-12 col-12">' +
          '<button id="add-product-btn" type="button" class="btn btn-secondary add_tier_bundle mob-width w-25" data-bundle="1" data-tier="' + tier + '">Add Product</button>' +
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
        $('#gig_ticket_tiers').append(
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12">' +
          '<div id="gig_tier' + tier + '">' +
          '<ul>' +
          '<li><label class="m-0 font-weight-bold">Tier Name<p class="ticket_name"></p></label></li>' +
          '<li><label class="m-0 font-weight-bold">Tier Price<p class="ticket_price"></p></label></li>' +
          '<li><label class="m-0 font-weight-bold">Number of tickets<p class="ticket_quantity"></p></label></li>' +
          '<li><label class="m-0 font-weight-bold">Tier Description<p class="ticket_description"></p></label></li>' +
          '<li><label class="m-0 font-weight-bold"><p class="ticket_is_unlimited d-none">*Unlimited</p></label></li>' +
          '</ul>' +
          '</div>' +
          '</div>'
        );
        tier = tier - -1;
        $(this).attr('data-tier', tier);
      });
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
        // $('.file-input').fileinput({
        //   browseLabel: 'Browse',
        //   previewFileType: 'image',
        //   browseIcon: '<i class="icon-image2 mr-2"></i>',
        //   initialCaption: "No file selected",
        //   fileActionSettings: fileActionSettings
        // });
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
    });
    // $('#start_time').change(function() {
    //   var time = $(this).val();
    //   $('#end_time').attr('min', time);
    //   $('#end_time').attr('max', '23:59');
    // })
    $('#goal').change(function() {
      var goal = $(this).val();
      var threshold = Math.round(goal * .6);
      $('#threshold').val(threshold);
    })

    // function preview(input) {
    //   var e_val = input.value;
    //   var e_name = input.getAttribute("name");
    //   var e_type = input.type;
    //   if (e_name == 'venues[]') {
    //     if (e_name == 'venues[]' && input.checked) {
    //       $('#gig_venues').append('<div id="gig_' + e_val + '">' + e_val + '</div>');
    //     } else {
    //       // console.log(e_val);
    //       $('#gig_' + e_val).remove();
    //     }
    //   }
    //   if (e_name == 'is_overshoot') {
    //     // console.log(input.checked);
    //     if (input.checked) {
    //       $('#gig_' + e_name).removeClass('d-none');
    //     } else {
    //       $('#gig_' + e_name).addClass('d-none');
    //     }
    //   }
    //   if (e_type == 'text') {
    //     $('#gig_' + e_name).html(e_val);
    //   }
    // }

    // function ticket_preview(input) {
    //   var t_val = input.value;
    //   var t_name = input.getAttribute("name").slice(0, -2);
    //   var t_type = input.type;
    //   if (t_type == 'text' || t_type == 'textarea' || t_type == 'number') {
    //     var tier = input.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
    //     $('#gig_' + tier).find('.' + t_name).html(t_val);
    //   }
    //   if (t_type == 'checkbox') {
    //     var tier = input.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
    //     if (input.checked) {
    //       $('#gig_' + tier).find('.' + t_name).removeClass('d-none');
    //     } else {
    //       $('#gig_' + tier).find('.' + t_name).addClass('d-none');
    //     }
    //   }
    // }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#img').attr('src', e.target.result);
          $('#img').removeClass('object-fit-cover').addClass('object-fit-contain');
          // $('#gig_poster').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    // const videoSrc = document.querySelector("#video-source");
    // const videoTag = document.querySelector("#video-tag");
    // const inputTag = document.querySelector("#video");
    // inputTag.addEventListener('change', readURLvideo)

    // function readURLvideo(event) {
    //   if (event.target.files && event.target.files[0]) {
    //     var reader = new FileReader();

    //     reader.onload = function(e) {
    //       videoSrc.src = e.target.result
    //       videoTag.load()
    //     }.bind(this)

    //     reader.readAsDataURL(event.target.files[0]);
    //   }
    // }
  </script>
</body>

</html>