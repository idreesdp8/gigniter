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
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="password" data-error="#password1">
                                        <span id="password1" class="text-danger" generated="true"><?php echo form_error('password'); ?></span>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label for="image">Image</label>
                                    <input type="hidden" id="old_image" value="<?php echo profile_image_url() . $user->image ?>">
                                    <input type="file" name="image" class="file-input-preview" accept=".jpg|.jpeg|.png|.gif" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false" data-fouc>
                                    <!-- <input type="file" name="image"> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" cols="30" rows="3" placeholder="Enter description" class="form-control"><?php echo $user->description ?></textarea>
                                    </div>
                                </div>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Enter city" value="<?php echo $user->city ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control" placeholder="Enter state" value="<?php echo $user->state ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control" placeholder="Enter country" value="<?php echo $user->country ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Zip</label>
                                        <input type="text" name="zip" class="form-control" placeholder="Enter zip" value="<?php echo $user->zip ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select name="role_id" class="form-control select" data-error="#role_id1">
                                            <option value="">Select Role</option>
                                            <?php if (isset($roles)) {
                                                foreach ($roles as $role) { ?>
                                                    <option value="<?php echo $role->id ?>" <?php echo $role->id == $user->role_id ? 'selected' : '' ?>><?php echo $role->name ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span id="role_id1" class="text-danger" generated="true"><?php echo form_error('role_id'); ?></span>
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
                    role_id: {
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
                    role_id: {
                        required: "Role is required field"
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