<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>Genres</title>
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
							<span class="breadcrumb-item active">Genres</span>
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
						<h5 class="card-title">Add Genre</h5>
					</div>

					<div class="card-body">
						<form action="<?php echo admin_base_url() ?>genres/add" method="post" id="datas_form">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" placeholder="Enter genre name" name="label" data-error="#label1">
								<span id="label1" class="text-danger" generated="true"><?php echo form_error('label'); ?></span>
							</div>

							<div class="text-right">
								<button type="submit" class="btn btn-primary"><i class="icon-add mr-2"></i> Add</button>
							</div>
						</form>
					</div>
				</div>
				<!-- /basic layout -->
				<!-- Striped rows -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Genres</h5>
						<div class="header-elements">
							<div class="list-icons">
								<!-- <a class="list-icons-item" data-action="collapse"></a> -->
								<a class="list-icons-item" data-action="reload"></a>
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
										<th>Genre Name</th>
										<th>Added on</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($records as $record) {
									?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $record->label ?></td>
											<td><?php echo date('M d, Y H:i A', strtotime($record->created_on)) ?></td>
											<td>
												<div class="d-flex">
													<button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-primary btn-icon editModal" data-value=<?php echo $record->id ?>><i class="icon-pencil7"></i></button>
													<form action="<?php echo admin_base_url() ?>genres/trash/<?php echo $record->id ?>">
														<button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
													</form>
												</div>
											</td>
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
				<!-- /striped rows -->

				<!-- Vertical form modal -->
				<div id="editModal" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Update Genre</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<form action="<?php echo admin_base_url() ?>genres/update" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label>Name</label>
										<input type="text" id="edit-label" class="form-control" name="label">
										<input type="hidden" id="edit-id" class="form-control" name="id">
									</div>

								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" class="btn bg-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /vertical form modal -->

			</div>

			<?php $this->load->view('admin/layout/footer'); ?>

		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#sidebar_configuration').addClass('nav-item-open');
			$('#sidebar_configuration ul').first().css('display', 'block');
			$('#sidebar_genre a').addClass('active');

			var validator = $('#datas_form').validate({
				rules: {
					label: {
						required: true
					}
				},
				messages: {
					label: {
						required: "Name is required field"
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

			$('.editModal').click(function() {
				var id = $(this).attr('data-value');
				var base_url = '<?php echo admin_base_url() ?>';
				// console.log(id);
				$.ajax({
					url: base_url + 'genres/edit',
					type: 'post',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						$('#edit-label').val(response.label);
						$('#edit-id').val(response.id);
					}
				});
			});
		});
	</script>
</body>

</html>