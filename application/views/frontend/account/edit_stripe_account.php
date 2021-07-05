<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Service</title>
    <style>
        .image_div {
            padding: 10px;
            border: 1px solid #0e1e5e;
            text-align: center;
            width: 100%;
            height: 270px;
            margin-bottom: 20px;
        }

        .image_div img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }

        .account-area .account-form .form-group input {
            color: black !important;
        }

        .link {
            color: #ffffffb3;
            border-bottom: 1px dashed;
            font-style: italic;
        }

        .link:hover {
            color: #e3e3e3;
            border-bottom: 0px;
        }
    </style>
</head>

<body>
    <?php $this->load->view('frontend/layout/preloader'); ?>
    <?php $this->load->view('frontend/layout/header'); ?>

    <!-- ==========Sign-In-Section========== -->
    <section class="account-section">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area" style="max-width: 100%;">
                    <?php $this->load->view('alert/alert'); ?>
                    <div class="section-header-3">
                        <span class="theme-primary-color cate">Update Stripe Info</span>
                        <!-- <h2 class="title">to Gigniter </h2> -->
                    </div>
                    <form name="datas_form" id="datas_form" class="account-form" action="<?php echo site_url('account/edit_stripe_account/'.$usrid); ?>" method="post">  
                        <div class="row"> 
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="stripe_id" class="w-100">Stripe Email  
										<span style="display:none" class="<?php echo ($user->detail_submitted_flag == 'enabled') ? 'text-success' : 'text-danger' ?>">
                                            <small>
                                                <?php
                                                if ($user->detail_submitted_flag == 'NA') {
                                                    echo 'No stripe account added';
                                                } else {
                                                    echo ($user->detail_submitted_flag == 'enabled') ? 'Enabled' : 'Restricted';
                                                }  ?>
                                            </small>
                                        </span>
										<span style="display:none" class="float-right">
										<?php  //enable_stripe_account
											if ($user->detail_submitted_flag == 'restricted'){ ?>
												<small>
													<a class="link" href="<?php echo user_base_url() . 'account/create_user_stripe_account?user_id=' . $user->id ?>">Enable Account</a> <!-- target="_blank" -->
												</small>
											<?php
											} ?>
										</span> 
									</label>
                                    <input type="text" value="<?php echo isset($row) ? $row->stripe_id : ''; ?>" name="stripe_id" id="stripe_id" data-error="#stripe_id1" /> <span id="stripe_id1" class="text-danger"> <?php echo form_error('stripe_id'); ?> </span>
                                </div>
                            </div>  
							
						  </div>	
						  <div class="row"> 	 
                            <div class="col-xl-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update</button>
                            </div>
							<div class="col-xl-9"> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->


    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>

    <script> 
        $(document).ready(function() {
            var validator = $('#datas_form').validate({
                rules: { 
                    stripe_id: {
                        required: true,
                    } 
                },
                messages: {
                    stripe_id: {
                        required: "Stripe ID is required field",
                    } 
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
                    document.forms["datas_form"].submit();
                }
            }); 
        });
    </script>
</body>

</html>