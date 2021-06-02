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
                  <p ><small>Test link</small></p>
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
                      <input type="text" id="title" name="title" required="required" onchange="preview(this)">
                      <span id="title1" class="text-danger" generated="true"><?php echo form_error('title'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig subtitle <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig subtitle"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="subtitle" name="subtitle" required="required" onchange="preview(this)">
                      <span id="subtitle1" class="text-danger" generated="true"><?php echo form_error('subtitle'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Category <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Category"><i class="fas fa-question-circle"></i></span>
                      <select id="category" name="category" class="select" required="required" onchange="preview(this)">
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
                      <select id="genre" name="genre" class="select" required="required" onchange="preview(this)">
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
                            <input id="myCheckbox-live_stream" name="venues[]" value="Live stream" type="checkbox" onchange="preview(this)">
                            <label for="myCheckbox-live_stream">Live stream</label>
                            <span></span>
                          </div>
                        </div>
                        <div class="mycheckbox-contain">
                          <div class="allow-overshoot">
                            <input id="myCheckbox-physical" name="venues[]" value="Physical" type="checkbox" onchange="preview(this)">
                            <label for="myCheckbox-physical">Physical</label>
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Upload Gig Poster <small class="text-warning">min 360px x 354px</small> <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Poster"><i class="fas fa-question-circle"></i></span>
                      <!-- or Pitch Video -->
                      <div class="gig-poster-wrapper">
                        <img class="object-fit-cover" id="img"  src="<?php echo user_asset_url(); ?>images/icons/img-demo-bg.png" alt="your image" />
                        <a><img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icons_upload"></a>
                        <input type='file' name="poster" id="poster" hidden="hidden" accept="image/*" onchange="readURL(this);" />
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label>
                      Enter Address <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Address"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="address" name="address" required="required" onchange="preview(this)">
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
                    Target audience number <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Target audience number"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="goal" name="goal" required="required" onchange="preview(this)">
                      <span id="goal1" class="text-danger" generated="true"><?php echo form_error('goal'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Ticket Threshold <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Ticket Threshold"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="threshold" name="threshold" required="required" onchange="preview(this)">
                      <span id="threshold1" class="text-danger" generated="true"><?php echo form_error('threshold'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Target Goal Amount <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Target Goal Amount"><i class="fas fa-question-circle"></i></span>
                      <input type="text" id="goal_amount" name="goal_amount" required="required" onchange="preview(this)">
                      <span id="goal_amount1" class="text-danger" generated="true"><?php echo form_error('goal_amount'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                  <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      <?php $curr_date = date('Y-m-d'); ?>
                      Campaign Launch Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Campaign Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="campaign_date" class="date" name="campaign_date" min="<?php echo $curr_date ?>" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required" onchange="preview(this)">
                      <span id="campaign_date1" class="text-danger" generated="true"><?php echo form_error('campaign_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Gig Date <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Date"><i class="fas fa-question-circle"></i></span>
                      <input type="date" id="gig_date" class="date" name="gig_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required" onchange="preview(this)">
                      <span id="gig_date1" class="text-danger" generated="true"><?php echo form_error('gig_date'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Start Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig Start Time"><i class="fas fa-question-circle"></i></span>
                      <input type="time" id="start_time" class="time" name="start_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required" onchange="preview(this)">
                      <span id="start_time1" class="text-danger" generated="true"><?php echo form_error('start_time'); ?></span>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      End Time <span class="float-right" data-toggle="tooltip" data-placement="top" title="This is Gig End Time"><i class="fas fa-question-circle"></i></span>
                      <input type="time" id="end_time" class="time" name="end_time" onfocus="(this.type='time')" onblur="if(!this.value)this.type='text'" required="required" onchange="preview(this)">
                      <span id="end_time1" class="text-danger" generated="true"><?php echo form_error('end_time'); ?></span>
                    </label>
                  </div> -->
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="mycheckbox-contain">
                      <div class="allow-overshoot">
                        <input id="myCheckbox-allow_overshoot" type="checkbox" name="is_overshoot" value="1" onchange="preview(this)">
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
                            <input type="text" name="ticket_name[]" placeholder="" onchange="ticket_preview(this)">
                          </label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <label>
                            Tier Price
                            <input type="number" name="ticket_price[]" placeholder="USD $" onchange="ticket_preview(this)">
                          </label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <label>
                            Number of tickets in Tier
                            <input type="number" name="ticket_quantity[]" placeholder="" onchange="ticket_preview(this)">
                          </label>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <label>
                            Description
                            <textarea name="ticket_description[]" cols="30" rows="2" onchange="ticket_preview(this)"></textarea>
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
                          <button type="button" class="btn btn-secondary add_tier_bundle mob-width w-25" data-bundle="1" data-tier="1">Add Product</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                          <div class="mycheckbox-contain">
                            <div class="allow-overshoot">
                              <input id="myCheckbox-ticket_is_unlimited_1" type="checkbox" name="ticket_is_unlimited_1" value="1" onchange="ticket_preview(this)">
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
                      <input type="text" id="user_address" name="user_address" value="<?php echo $user->address ?>">
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
                            <input type="text" class="social_url" name="mail" id="mail" value="<?php echo $link[0]['mail'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            <input type="text" class="social_url" name="facebook" id="facebook" value="<?php echo $link[1]['facebook'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
                            <input type="text" class="social_url" name="instagram" id="instagram" value="<?php echo $link[2]['instagram'] ?? null ?>">
                          </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <label>
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
                    <div class="step-form-heading">
                      <div class="gig-details">
                        <h2>Gig Details</h2>


                        <ul>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Title
                              <p id="gig_title"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Subtitle
                              <p id="gig_subtitle"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Category
                              <p id="gig_category"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Genre
                              <p id="gig_genre"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Venue(s)
                              <p id="gig_venues"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Address
                              <p id="gig_address"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Number of Tickets
                              <p id="gig_goal"></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Number of Tickets
                              <p id="gig_threshold"></p>
                            </label>
                          </li>
                          <!-- <li>
                            <label class="m-0 font-weight-bold">Gig Campaign Date
                              <p id="gig_subtitle">adadf</p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Date
                              <p id="gig_subtitle">adadf</p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig Start Time
                              <p id="gig_subtitle">adadf</p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">Gig End Time
                              <p id="gig_subtitle">adadf</p>
                            </label>
                          </li> -->
                          <li>
                            <label class="m-0 font-weight-bold">
                              <p id="gig_is_overshoot" class="d-none">*Overshoot allowed</p>
                            </label>
                          </li>
                          <li>
                            <label style="width: 100%;" class="m-0 poster-img font-weight-bold">Gig Poster
                              <img id="gig_poster" src="" width="100%">
                            </label>
                          </li>
                        </ul>
                      </div>

                      <div class="gig-details">
                        <h2>Gig Ticket Tiers</h2>
                        <div class="row" id="gig_ticket_tiers">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div id="gig_tier1">
                              <ul>
                                <li>
                                  <label class="m-0 font-weight-bold">Tier Name
                                    <p class="ticket_name"></p>
                                  </label>
                                </li>
                                <li>
                                  <label class="m-0 font-weight-bold">Tier Price
                                    <p class="ticket_price"></p>
                                  </label>
                                </li>
                                <li>
                                  <label class="m-0 font-weight-bold">Number of tickets
                                    <p class="ticket_quantity"></p>
                                  </label>
                                </li>
                                <li>
                                  <label style="width: 50%;" class="m-0 font-weight-bold">Tier Description
                                    <p class="ticket_description"></p>
                                  </label>
                                </li>
                                <li>
                                  <label class="m-0 font-weight-bold">
                                    <p class="ticket_is_unlimited d-none">*Unlimited</p>
                                  </label>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="gig-details">
                        <h2>User details</h2>
                        <ul>
                          <li>
                            <label class="m-0 font-weight-bold">User Name
                              <p id="gig_user_name"><?php echo $user->fname . ' ' . $user->lname ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User Bio
                              <p id="gig_user_bio"><?php echo $user->description ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User Address
                              <p id="gig_user_address"><?php echo $user->address ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User Mail
                              <p id="gig_mail"><?php echo $link[0]['mail'] ?? null ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User Facebook URL
                              <p id="gig_facebook"><?php echo $link[1]['facebook'] ?? null ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User instagram URL
                              <p id="gig_instagram"><?php echo $link[2]['instagram'] ?? null ?></p>
                            </label>
                          </li>
                          <li>
                            <label class="m-0 font-weight-bold">User twitter URL
                              <p id="gig_twitter"><?php echo $link[3]['twitter'] ?? null ?></p>
                            </label>
                          </li>
                          <li>
                            <label style="width: 50%;margin-left: 30px;" class="m-0 profile-img font-weight-bold">Profile Image
                              <img style="width: 100px;margin-left: 30px;" id="gig_user_iamge" src="<?php echo $user->image ? profile_image_url() . $user->image : user_asset_url() . 'images/icons/img-demo-bg.png' ?>" width="100%">
                            </label>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-buttons">
                      <input type="hidden" name="is_draft" id="is_draft">
                      <button type="submit" class="btn btn-secondary" onclick="submit_form(1)">Save as Draft</button>
                      <?php
                      if (!$gig) :
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
  <script src="<?php echo user_asset_url(); ?>js/step-form.js"></script>
  <script src="<?php echo user_asset_url(); ?>js/upload-gig-img.js"></script>
  <script>
    function submit_form(val) {
      $('#is_draft').val(val);
    }
    $(document).ready(function() {

      $('#start_gig_menu').addClass('active');

      $('#campaign_date').change(function() {
        var campaign_date = new Date($(this).val());
        var gig_min_date = campaign_date.toISOString().substring(0, 10);
        var gig_max_date = new Date(campaign_date.setDate(campaign_date.getDate() + 30));
        gig_max_date = gig_max_date.toISOString().substring(0, 10);
        $('#gig_date').attr('min', gig_min_date);
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
          '<label>Tier Name<input type="text" name="ticket_name[]" placeholder="" onchange="ticket_preview(this)"></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Tier Price<input type="number" name="ticket_price[]" placeholder="USD $" onchange="ticket_preview(this)"></label>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<label>Number of tickets in Tier<input type="number" name="ticket_quantity[]" placeholder="" onchange="ticket_preview(this)"></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12">' +
          '<label>Description<textarea name="ticket_description[]" cols="30" rows="2" onchange="ticket_preview(this)"></textarea></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-12 col-sm-12 col-12 tier_bundles">' +
          '<label class="d-none">Products<div class="row mb-2"></div></label>' +
          '</div>' +
          '<div class="col-lg-12 col-md-4 col-sm-12 col-12">' +
          '<button type="button" class="btn btn-secondary add_tier_bundle mob-width w-25" data-bundle="1" data-tier="' + tier + '">Add Product</button>' +
          '</div>' +
          '<div class="col-lg-4 col-md-4 col-sm-12 col-12">' +
          '<div class="mycheckbox-contain">' +
          '<div class="allow-overshoot">' +
          '<input id="myCheckbox-ticket_is_unlimited_' + tier + '" type="checkbox" name="ticket_is_unlimited_' + tier + '" value="1" onchange="ticket_preview(this)">' +
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
        var foo =  "<?php echo user_asset_url(); ?>images/icons/img-plus.png";
        div.append(
          '<div class="col-md-4">' +
          '<div class = "cursor-pointer text-right mb-2 text-danger remove_tier_bundle"><i style="font-size: 18px;border: 1px solid;padding: 3px;" class="fas fa-times"></i></div>' +
          '<div class="form-group">' +
          '<input type="text" name="bundle_title_tier' + tier + '[]" placeholder="Bundle Title">' +
          '</div>' +
          '<div class="image_div">' +
          '<img alt="your image" class="d-none" />' +
          '</div>' +
          '<label for="file-upload1" class="custom-file-upload">' +
          '<img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icon_upload1">' +
          '</label>' +
          '<input id="file-upload1" type="file" name="bundle_image_tier' + tier + '[]" accept="image/*" onchange="read_bundle_image(this);" />' +
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
      $(document).on('click', '.remove_tier', function() {
        var div = $(this).parents('.ticket_tier');
        var tier = div.children().first().attr('id');
        $('#gig_' + tier).parent().remove();
        div.remove();
      });
    });

    function preview(input) {
      var e_val = input.value;
      var e_name = input.getAttribute("name");
      var e_type = input.type;
      if (e_name == 'venues[]') {
        if (e_name == 'venues[]' && input.checked) {
          $('#gig_venues').append('<div id="gig_' + e_val + '">' + e_val + '</div>');
        } else {
          // console.log(e_val);
          $('#gig_' + e_val).remove();
        }
      }
      if (e_name == 'is_overshoot') {
        // console.log(input.checked);
        if (input.checked) {
          $('#gig_' + e_name).removeClass('d-none');
        } else {
          $('#gig_' + e_name).addClass('d-none');
        }
      }
      if (e_type == 'text') {
        $('#gig_' + e_name).html(e_val);
      }
    }

    function ticket_preview(input) {
      var t_val = input.value;
      var t_name = input.getAttribute("name").slice(0, -2);
      var t_type = input.type;
      if (t_type == 'text' || t_type == 'textarea' || t_type == 'number') {
        var tier = input.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
        $('#gig_' + tier).find('.' + t_name).html(t_val);
      }
      if (t_type == 'checkbox') {
        var tier = input.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
        if (input.checked) {
          $('#gig_' + tier).find('.' + t_name).removeClass('d-none');
        } else {
          $('#gig_' + tier).find('.' + t_name).addClass('d-none');
        }
      }
    }

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
