<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Update User</title>
    <style>
        .file-preview-frame {
            margin: auto !important;
        }

        .file-thumbnail-footer {
            display: none;
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
                            <a href="<?php echo admin_base_url(); ?>users" class="breadcrumb-item"> Users</a>
                            <span class="breadcrumb-item active">Update User</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view('alert/alert'); ?>
                <!-- Basic layout-->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Update User</h5>
                    </div>

                    <form action="<?php echo admin_base_url() ?>users/update" method="post" enctype="multipart/form-data" id="datas_form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                                                <input type="text" class="form-control" placeholder="Enter first name" name="fname" value="<?php echo $user->fname ?>" data-error="#name1">
                                                <span id="name1" class="text-danger" generated="true"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Enter last name" name="lname" value="<?php echo $user->lname ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $user->email ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="text-info">Leave password field empty if you do not want to change it!</span></label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="password" data-error="#password1">
                                        <span id="password1" class="text-danger" generated="true"><?php echo form_error('password'); ?></span>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label for="image">Image</label>
                                    <input type="hidden" class="old_image" value="<?php echo profile_image_url() . $user->image ?>">
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
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="description" cols="30" rows="3" placeholder="Enter description" class="form-control"><?php echo $user->description ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <!-- <div class="col-md-12">
                                            
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone #</label>
                                                <input type="text" name="phone_no" class="form-control" placeholder="Enter phone number" value="<?php echo $user->phone_no ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile #</label>
                                                <input type="text" name="mobile_no" class="form-control" placeholder="Enter mobile number" value="<?php echo $user->mobile_no ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" cols="30" rows="2" placeholder="Enter address" class="form-control"><?php echo $user->address ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select">
                                                    <option value="0" <?php echo !$user->status ? 'selected' : '' ?>>Inactive</option>
                                                    <option value="1" <?php echo $user->status ? 'selected' : '' ?>>Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Social Links</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-envelop"></i></span>
                                            </span>
                                            <input name="mail" type="text" class="form-control" placeholder="mail url" value=<?php echo $link[0]['mail'] ?? null ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-facebook2"></i></span>
                                            </span>
                                            <input name="facebook" type="text" class="form-control" placeholder="facebook url" value=<?php echo $link[1]['facebook'] ?? null ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-instagram"></i></span>
                                            </span>
                                            <input name="instagram" type="text" class="form-control" placeholder="instagram url" value=<?php echo $link[2]['instagram'] ?? null ?>>
                                        </div>
                                    </div>
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

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil mr-2"></i> Update</button>
                                <a href="<?php echo $this->agent->referrer(); ?>" type="button" class="btn bg-slate"><i class="icon-cancel-circle2 mr-2"></i> Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /basic layout -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebar_user').addClass('nav-item-open');
            $('#sidebar_user ul').first().css('display', 'block');
            $('#sidebar_user_view a').addClass('active');

            var validator = $('#datas_form').validate({
                rules: {
                    fname: {
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
        });
    </script>
</body>

</html>