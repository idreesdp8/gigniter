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

    .text-danger .error {
      border: none !important;
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
                  <h6>Enter Gig Details</h6>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig Title
                      <input type="text" id="title" name="title" required="required">
                      <span id="title1" class="text-danger" generated="true"><?php echo form_error('title'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig subtitle
                      <input type="text" id="subtitle" name="subtitle" required="required">
                      <span id="subtitle1" class="text-danger" generated="true"><?php echo form_error('subtitle'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Category
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
                      Enter Gig Genre
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
                    <label>Venue
                      <div class="d-flex">
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-live_stream" name="venues[]" value="live-stream" type="checkbox">
                            <label for="myCheckbox-live_stream">Live stream</label>
                            <span></span>
                          </div>
                        </div>
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-physical" name="venues[]" value="physical" type="checkbox">
                            <label for="myCheckbox-physical">Physical</label>
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Upload Gig Poster
                      <!-- or Pitch Video -->
                      <div>
                        <img id="img" src="<?php echo user_asset_url(); ?>images/icons/img-demo-bg.png" alt="your image" />
                        <a><img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icon_for_upload"></a>
                        <input type='file' name="poster" id="poster" hidden="hidden" accept="image/*" onchange="readURL(this);" />
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Enter Address
                      <input type="text" id="address" name="address" required="required">
                      <span id="address1" class="text-danger" generated="true"><?php echo form_error('address'); ?></span>
                    </label>
                  </div>
                  <!-- <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div> -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Enter Gig Details</h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Goal
                      <input type="text" id="goal" name="goal" required="required">
                      <span id="goal1" class="text-danger" generated="true"><?php echo form_error('goal'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Campaign Launch Date
                      <input type="text" id="campaign_date" class="date" name="campaign_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="campaign_date1" class="text-danger" generated="true"><?php echo form_error('campaign_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Gig Date
                      <input type="text" id="gig_date" class="date" name="gig_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="gig_date1" class="text-danger" generated="true"><?php echo form_error('gig_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Start Time
                      <input type="text" id="start_time" class="time" name="start_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required">
                      <span id="start_time1" class="text-danger" generated="true"><?php echo form_error('start_time'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      End Time
                      <input type="text" id="end_time" class="time" name="end_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required">
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
                      <h5>Tier 1</h5>
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
                            <input type="text" name="ticket_price[]" placeholder="USD $">
                          </label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <label>
                            Number of tickets in Tier
                            <input type="text" name="ticket_quantity[]" placeholder="">
                          </label>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <label>
                            Description
                            <textarea name="ticket_description[]" cols="30" rows="2"></textarea>
                          </label>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">
                          <label class="d-none">
                            Products
                            <div class="row mb-2">
                            </div>
                          </label>
                        </div>
                        <div class="col-lg-12 col-md-4 col-sm-12 col-12">
                          <button type="button" class="btn btn-secondary add_tier_bundle w-25" data-bundle="1" data-tier="1">Add Product</button>
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
                <!-- <hr>
                <div id="tier2">
                  <h5>Tier 2</h5>
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
                        <input type="text" name="ticket_price[]" placeholder="USD $">
                      </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <label>
                        Number of tickets in Tier
                        <input type="text" name="ticket_quantity[]" placeholder="">
                      </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                      <label>
                        Description
                        <textarea name="ticket_description[]" cols="30" rows="2"></textarea>
                      </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">
                      <label class="d-none">
                        Bundling Details
                        <div class="row mb-2">
                        </div>
                      </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="mycheckbox-contain">
                        <div class="allow-overshoot">
                          <input id="myCheckbox-ticket_is_unlimited_2" type="checkbox" name="ticket_is_unlimited_2" value="1">
                          <label for="myCheckbox-ticket_is_unlimited_2">No Limit</label>
                          <span></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="2">Add Bundle</button>
                    </div>
                  </div>
                </div>
                <hr>
                <div id="tier3">
                  <h5>Tier 3</h5>
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
                        <input type="text" name="ticket_price[]" placeholder="USD $">
                      </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <label>
                        Number of tickets in Tier
                        <input type="text" name="ticket_quantity[]" placeholder="">
                      </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                      <label>
                        Description
                        <textarea name="ticket_description[]" cols="30" rows="2"></textarea>
                      </label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">
                      <label class="d-none">
                        Bundling Details
                        <div class="row mb-2">
                        </div>
                      </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="mycheckbox-contain">
                        <div class="allow-overshoot">
                          <input id="myCheckbox-ticket_is_unlimited_3" type="checkbox" name="ticket_is_unlimited_3" value="1">
                          <label for="myCheckbox-ticket_is_unlimited_3">No Limit</label>
                          <span></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                      <button type="button" class="btn btn-primary add_tier_bundle" data-bundle="1" data-tier="3">Add Bundle</button>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary" id="add_tier_button" data-tier="2">Add Tier</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button type="button" class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
                <!-- </form> -->
              </div>

              <div class="panel panel-primary setup-content" id="step-3">
                <!-- <form id="form_step_3" enctype="multipart/form-data"> -->
                <div class="step-form-heading">
                  <h6>Build Your Profile</h6>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Profile Image
                      <div>
                        <img id="img2" src="<?php echo $user->image ? profile_image_url() . $user->image : user_asset_url() . 'images/icons/img-demo-bg.png' ?>" alt="your image" />
                        <a><img src="<?php echo $user->image ? '' : user_asset_url() . 'images/icons/img-plus.png' ?>" id="icon_for_upload"></a>
                        <input type='file' id="my-file2" name="image" hidden="hidden" accept="image/*" onchange="readURL2(this);" />
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      First Name
                      <input type="text" id="fname" name="fname" value="<?php echo $user->fname ?>">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Last Name
                      <input type="text" id="lname" name="lname" value="<?php echo $user->lname ?>">
                    </label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <label>
                      Bio
                      <textarea type="text" id="description" name="description" class="textarea" rows="3"><?php echo $user->description ?></textarea>
                    </label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Address
                      <input type="text" name="user_address" value="<?php echo $user->address ?>">
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
                          <option value="<?php echo $country->id ?>" <?php echo $country->id == $user->country_id ? 'selected' : '' ?>><?php echo $country->name ?></option>
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
                            <input type="text" class="social_url" name="mail" value=<?php echo $link[0]['mail'] ?? null ?>>
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            <input type="text" class="social_url" name="facebook" value=<?php echo $link[1]['facebook'] ?? null ?>>
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            <input type="text" class="social_url" name="instagram" value=<?php echo $link[2]['instagram'] ?? null ?>>
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            <input type="text" class="social_url" name="twitter" value=<?php echo $link[3]['twitter'] ?? null ?>>
                          </label>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Stripe integration
                      <!-- -->
                      <input type="text" id="stripe_integration" name="stripe_integration">
                    </label>
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

              <div class="panel panel-primary setup-content" id="step-4">
                <!-- <form id="form_step_3"> -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Test Links</h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Select the meeting platform
                      <select id="meeting_platform" class="select">
                        <option>Google Meeting</option>
                        <option>Zoom Meeting</option>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter url
                      <input type="text" id="meeting_url" name="meeting_url">
                    </label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-launch">Launch campaign</button>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-test">test</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Ticket Sold</h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      First Name
                      <input type="text" id="first_name" name="first_name">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Last Name
                      <input type="text" id="last_name" name="last_name">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Ticket Tier
                      <input type="text" id="ticket_tier" name="ticket_tier">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Sold Price
                      <input type="text" id="sold_price" placeholder="USD $">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Purchase dates
                      <input type="text" id="purchase_date" class="date" name="gig-date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                    </label>
                  </div>
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
                    <div class="step-form-heading">
                      <button type="submit" class="btn btn-success" id="submit_button">Add Gig</button>
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
  <script src="<?php echo user_asset_url(); ?>js/step-form.js"></script>
  <script src="<?php echo user_asset_url(); ?>js/upload-gig-img.js"></script>
  <script>
    const base_url = '<?php echo user_base_url() ?>';
    $(document).ready(function() {
      $('#start_gig_menu').addClass('active');


      $('#add_tier_button').click(function() {
        var tier = $(this).data('tier');
        var div = $('#ticket_tiers');
        div.append(
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">' +
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
          '<button type="button" class="btn btn-secondary add_tier_bundle w-25" data-bundle="1" data-tier="'+tier+'">Add Product</button>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<div class="mycheckbox-contain">' +
          '<div class="allow-overshoot">' +
          '<input id="myCheckbox-ticket_is_unlimited_'+tier+'" type="checkbox" name="ticket_is_unlimited_'+tier+'" value="1">' +
          '<label for="myCheckbox-ticket_is_unlimited_'+tier+'">No Limit</label><span></span>' +
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
      $(document).on('click', '.add_tier_bundle', function() {
        var i = $(this).attr('data-bundle');
        var tier = $(this).data('tier');
        var div = '#tier' + tier;
        var label = $(this).parents(div).find('.tier_bundles label');
        label.removeClass('d-none');
        var div = $(this).parents(div).find('.tier_bundles .row');
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
      $('#basic_info_form').submit(function(e) {
        e.preventDefault;
        let formData1 = new FormData($("#form_step_1")[0]);
        let formData2 = new FormData($("#form_step_2")[0]);
        let formData3 = new FormData($("#form_step_3")[0]);
        for (var pair of formData2.entries()) {
          formData1.append(pair[0], pair[1]);
        }
        for (var pair of formData3.entries()) {
          formData1.append(pair[0], pair[1]);
        }
        // console.log(formData1);
        // return false;
        // var data = $('#form_step_1').serialize() + '&' + $('#form_step_2').serialize() + '&' + $('#form_step_3').serialize();
        // alert(data);
        var form = $(this);
        // var base_url = 'https://gigniter.digitalpoin8.com/index.php/';
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: formData1,
          dataType: 'json',
          success: function(data) {
            // if (data.status == '200') {
            //   window.location = base_url;
            // }
          },
          error: function(e) {
            alert('Error adding gig');
          }
        });
        return false;
      });
    });
  </script>
</body>

</html>