<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('frontend/layout/meta_tags'); ?>
  <title>Gigniter - Online Ticket Booking Website HTML Template</title>
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
                  <a href="#step-1" type="button" class="btn btn-success-circle btn-circle line progress_step_1">1</a>
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


            <form role="form">
              <div class="panel panel-primary setup-content" id="step-1">
                <div class="step-form-heading">
                  <h6>Enter Gig Details</h6>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig Title
                      <input type="text" id="title" name="gig-title" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Gig subtitle
                      <input type="text" id="sub-title" name="gig-subtitle" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Gig Category
                      <select required="required" id="category" class="select">
                        <option></option>
                        <option>Demo 1</option>
                        <option> Demo 2</option>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Upload Gig Poster or Pitch Video
                      <div>
                        <img id="img" src="<?php echo user_asset_url(); ?>images/icons/img-demo-bg.png" alt="your image" />
                        <a><img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icon_for_upload"></a>
                        <input type='file' id="my-file" hidden="hidden" accept="images/*" onchange="readURL(this);" required="required" />
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Enter Address
                      <input type="text" id="gig-address" name="Address" required="required">
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Enter Gig Details</h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter Goal
                      <input type="text" id="goal" name="gig-Goal" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Gig Date
                      <input type="text" id="gig_date" class="date" name="gig-date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Launch Date
                      <input type="text" id="launch_date" class="date" name="Launch-date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="mycheckbox-contain">
                      <div class="allow-overshoot">
                        <input id="myCheckbox-allow" type="checkbox" checked required="required">
                        <label for="myCheckbox-allow">Allow overshoot</label>
                        <span></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
              </div>

              <div class="panel panel-primary setup-content" id="step-2">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Tier Price
                      <input type="text" id="tier_price" name="gig-title" placeholder="USD $" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Number of tickets in Tier
                      <select required="required" id="number_tickets" class="select">
                        <option></option>
                        <option>Demo 1</option>
                        <option> Demo 2</option>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Bundling Details
                      <input type="text" id="bundling" name="gig-title" required="required">
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="mycheckbox-contain">
                      <div class="allow-overshoot">
                        <input id="myCheckbox-allow" type="checkbox" checked required="required">
                        <label for="myCheckbox-allow">No Limit</label>
                        <span></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
              </div>

              <div class="panel panel-primary setup-content" id="step-3">
                <div class="step-form-heading">
                  <h6>Build Your Profile</h6>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <label>
                      Upload Gig Poster or Pitch Video
                      <div>
                        <img id="img2" src="<?php echo user_asset_url(); ?>images/icons/img-demo-bg.png" alt="your image" />
                        <a><img src="<?php echo user_asset_url(); ?>images/icons/img-plus.png" id="icon_for_upload"></a>
                        <input type='file' id="my-file2" hidden="hidden" accept="images/*" onchange="readURL2(this);" required="required" />
                      </div>
                    </label>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Full Name
                      <input type="text" id="full_name" name="Name" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <label>
                      Bio
                      <textarea type="text" id="bio" required="required" class="textarea"></textarea>
                    </label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Website
                      <input type="text" id="website" name="website" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Location
                      <input type="text" id="location" name="location" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Social urls
                      <input type="text" id="social_url" name="social_url" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Stripe integration
                      <input type="text" id="stripe_integration" name="stripe_integration" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
              </div>



              <div class="panel panel-primary setup-content" id="step-4">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Test Links</h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Select the meeting platform
                      <select required="required" id="meeting_platform" class="select">
                        <option>Google Meeting</option>
                        <option>Zoom Meeting</option>
                      </select>
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Enter url
                      <input type="text" id="meeting_url" name="meeting_url" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-launch">Launch campaign</button>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-test">test</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>Ticket Sold</h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      First Name
                      <input type="text" id="first_name" name="first_name" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Last Name
                      <input type="text" id="last_name" name="last_name" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Ticket Tier
                      <input type="text" id="ticket_tier" name="ticket_tier" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Sold Price
                      <input type="text" id="sold_price" placeholder="USD $" required="required">
                    </label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <label>
                      Purchase dates
                      <input type="text" id="purchase_date" class="date" name="gig-date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required="required">
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <button class="btn btn-primary btn-step-continue nextBtn">save & Continue</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12"></div>
                </div>
              </div>


              <div class="panel panel-primary setup-content" id="step-5">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="step-form-heading">
                      <h6>NOTHING HERE YET...</h6>
                    </div>
                  </div>
                </div>
              </div>

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
    // $(document).ready(function() {
    //     $('#explore_menu').addClass('active');
    //     $('.list-view').addClass("active");
    //     $('#grid_view').hide();

    //     $('#list-btn').click(function(event) {
    //         $('.grid-view').removeClass("active");
    //         $('.list-view').addClass("active");
    //         $('#grid_view').hide();
    //         $('#list_view').show();
    //     });

    //     $('#grid-btn').click(function(event) {
    //         $('.grid-view').addClass("active");
    //         $('.list-view').removeClass("active");
    //         $('#grid_view').show();
    //         $('#list_view').hide();
    //     });
    // });
  </script>
</body>

</html>