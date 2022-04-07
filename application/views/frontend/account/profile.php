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
                        <span class="theme-primary-color cate">Profile</span>
                        <!-- <h2 class="title">to Gigniter </h2> -->
                    </div>
                    <form class="account-form" id="datas_form" action="<?php echo site_url('account/edit_profile/'. $user_id ); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xl-6">
                                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                                <div class="form-group">
                                    <label for="fname">First Name<span>*</span></label>
                                    <input type="text" value="<?php echo $user->fname ?>" name="fname" id="fname" data-error="#fname1" required>
                                    <span id="fname1" class="text-danger"><?php echo form_error('fname'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name<span>*</span></label>
                                    <input type="text" value="<?php echo $user->lname ?>" name="lname" id="lname" data-error="#lname1" required>
                                    <span id="lname1" class="text-danger"><?php echo form_error('lname'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" value="<?php echo $user->email ?>" name="email" id="email" data-error="#email1" disabled>
                                    <span id="email1" class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <small class="text-warning">Leave field empty if you do not want to change password</small></label>
                                    <input type="password" placeholder="Password" name="password" id="password" data-error="#password1">
                                    <span id="password1" class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <div class="image_div">
                                        <img src="<?php echo $user->image ? profile_image_url() . $user->image : user_asset_url() . 'images/icons/img-demo-bg.png' ?>" alt="your image" />
                                    </div>
                                    <input type='file' id="image" name="image" accept="image/*" onChange="readURL(this);" data-error="#image1" />
                                    <label class="profile-edit" for="image">Select a file</label>
                                    <span id="image1" class="text-danger" generated="true">
                                        <?php
                                        echo form_error('image');
                                        if (isset($_SESSION['prof_img_error'])) {
                                            echo $_SESSION['prof_img_error'];
                                        } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Bio</label>
                            <textarea id="description" name="description" class="form-control" rows="3"><?php echo $user->description ?></textarea>
                        </div>
						  
                        <div class="row">
							<div class="col-xl-6">
								<div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" value="<?php echo $user->address ?>" name="address" id="address" data-error="#address1">
                            <span id="address1" class="text-danger"><?php echo form_error('address'); ?></span>
                        </div>
							</div> 
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="country_id">Location</label>
                                    <select name="country_id" id="country_id" class="form-control" data-error="#country_id1">
                                        <option value="">Choose Location</option>
                                        <?php
                                        if ($countries) :
                                            foreach ($countries as $country) :
                                        ?>
                                                <option value="<?php echo $country->id ?>" <?php echo $country->id == $user->country_id ? 'selected' : '' ?>><?php echo $country->name ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                <span id="country_id1" class="text-danger"><?php echo form_error('country_id'); ?></span>
                               </div>
                            </div>  
						  </div>
							
						<div class="row">
                            <div class="col-xl-12"> 
                                <h6>Social urls</h6>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="mail">Mail</label>
                                    <input type="text" value="<?php echo $user->mail ?? '' ?>" name="mail" id="mail" data-error="#mail1">
                                    <span id="mail1" class="text-danger"><?php echo form_error('mail'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" value="<?php echo $user->facebook ?? '' ?>" name="facebook" id="facebook" data-error="#facebook1">
                                    <span id="facebook1" class="text-danger"><?php echo form_error('facebook'); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" value="<?php echo $user->instagram ?? '' ?>" name="instagram" id="instagram" data-error="#instagram1">
                                    <span id="instagram1" class="text-danger"><?php echo form_error('instagram'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" value="<?php echo $user->twitter ?? '' ?>" name="twitter" id="twitter" data-error="#twitter1">
                                    <span id="twitter1" class="text-danger"><?php echo form_error('twitter'); ?></span>
                                </div>
                            </div>
                            <?php if($count) : ?>
                            <div class="col-xl-9"></div>
                            <div class="col-xl-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update</button>
                            </div>
                            <?php endif; ?>
						</div> 
						
                    </form> 
					<!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->


    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.image_div img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            var validator = $('#datas_form').validate({
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    password: {
                        minlength: 5
                    },
                    image: {
                        accept: "gif|png|jpg|jpeg"
                    }
                },
                messages: {
                    fname: {
                        required: "First name is required field"
                    },
                    lname: {
                        required: "Last name is required field"
                    },
                    password: {
                        minlength: "Minimum 5 characters needed!"
                    },
                    image: {
                        accept: "Accepts images having extension gif|png|jpg|jpeg"
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
            // $('.link').click(function(e) {
            //     e.preventDefault();
            //     var url = $(this).attr('href');
            //     var user_id = $('input[name=id]').val();
            //     // console.log(url);
            //     // console.log(user_id);
            //     $.ajax({
            //         url: url,
            //         method: 'get',
            //         data: {
            //             'user_id': user_id
            //         },
            //         dataType: 'json',
            //         success: function(res) {
            //             console.log(res);
            //             window.location.href = res.url;
            //         }
            //     });
            // });
        });
    </script>
</body>

</html>