<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('admin/layout/meta_tags'); ?>
  <title>Add Role</title>
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
              <a href="<?php echo admin_base_url(); ?>roles" class="breadcrumb-item"> Roles</a>
              <span class="breadcrumb-item active">Add Role</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>
      </div>
      <div class="content">
        <?php $this->load->view('alert/alert'); ?>
        <!-- Basic layout-->
        <form action="<?php echo admin_base_url() ?>roles/add" method="post">
        <div class="card">
          <div class="card-header header-elements-inline">
            <h5 class="card-title">Add Role</h5>
          </div>

          <div class="card-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter role name" name="name">
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="icon-add mr-2"></i> Add</button>
              </div>
          </div>
        </div>
        <!-- /basic layout -->
        <!-- Striped rows -->
        <div class="card">
          <div class="card-header header-elements-inline">
            <h5 class="card-title">Permissions</h5>
            <div class="header-elements">
              <div class="list-icons">
                <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                <!-- <a class="list-icons-item" data-action="reload"></a> -->
                <!-- <a class="list-icons-item" data-action="remove"></a> -->
              </div>
            </div>
          </div>

          <!-- <div class="card-body">
            Example of a table with <code>striped</code> rows. Use <code>.table-striped</code> added to the base <code>.table</code> class to add zebra-striping to any table odd row within the <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and lower as <code>:nth-child</code> CSS selector isn't supported in these browser versions. Striped table can be combined with other table styles.
          </div> -->

          <div class="table-responsive">
            <table class="table table-striped">
              <?php if (isset($records) && count($records) > 0) { ?>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Permission Name</th>
                    <th>Select</th>
                    <th>Added on</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($records as $record) {
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $record->name ?></td>
                      <td>
                        <div class="form-check form-check-switchery">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input-switchery-primary" name="permission_ids[]" value="<?php echo $record->id ?>" data-fouc>
                            <!-- Unchecked switch -->
                          </label>
                        </div>
                      </td>
                      <td><?php echo date('M d, Y H:i A', strtotime($record->created_on)) ?></td>
                    </tr>
                  <?php
                    $i++;
                  }
                  ?>
                </tbody>
              <?php } else { ?>
                <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
              <?php } ?>
            </table>
          </div>
        </div>
        </form>
        <!-- /striped rows -->

      </div>

      <?php $this->load->view('admin/layout/footer'); ?>

    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#sidebar_role_permission').addClass('nav-item-open');
      $('#sidebar_role_permission ul').first().css('display', 'block');
      $('#sidebar_role').addClass('nav-item-open');
      $('#sidebar_role ul').first().css('display', 'block');
      $('#sidebar_role_add a').addClass('active');
    });
  </script>
</body>

</html>