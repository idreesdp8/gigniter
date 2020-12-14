<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Users</title>
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
                            <span class="breadcrumb-item active">Users</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php $this->load->view('alert/alert'); ?>
                <!-- Striped rows -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Users</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <label class="mb-0">Filter: </label>
                                <select name="role" id="role" class="form-control select">
                                    <option value="">Select a role</option>
                                    <?php if (isset($roles)) {
                                        foreach ($roles as $role) { ?>
                                            <option value="<?php echo $role->id ?>"><?php echo $role->name ?></option>
                                    <?php  }
                                    } ?>
                                </select>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search by name | email">
                                <!-- <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a> -->
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card-body">
						Example of a table with <code>striped</code> rows. Use <code>.table-striped</code> added to the base <code>.table</code> class to add zebra-striping to any table odd row within the <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and lower as <code>:nth-child</code> CSS selector isn't supported in these browser versions. Striped table can be combined with other table styles.
					</div> -->

                    <div class="table-responsive">
                        <div id="table">
                            <?php $this->load->view('admin/users/index_partial'); ?>
                        </div>
                    </div>
                </div>
                <!-- /striped rows -->

            </div>

            <?php $this->load->view('admin/layout/footer'); ?>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebar_user').addClass('nav-item-open');
            $('#sidebar_user ul').first().css('display', 'block');
            $('#sidebar_user_view a').addClass('active');

            function filter(role_id = '', search = '') {
                console.log(role_id);
                console.log(search);
                var base_url = '<?php echo admin_base_url() ?>';
                $.ajax({
                    url: base_url + 'users/search',
                    type: 'post',
                    data: {
                        role_id: role_id,
                        search: search
                    },
                    success: function(response) {
                        $('#table').html('');
                        $('#table').html(response);
                    }
                });
            }

            $('#role').change(function() {
                var role_id = $(this).val();
                var search = $('#search').val();
                filter(role_id, search);
            });
            var timer;
            $('#search').keyup(function() {
                clearTimeout(timer);
                var role_id = $('#role').val();
                var search = $(this).val();
                timer = setTimeout(function() {
                    filter(role_id, search);
                }, 500);
            });
        });
    </script>
</body>

</html>